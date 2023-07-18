use std::path::PathBuf;

use anyhow::Result;
use clap::{Parser, Subcommand, ValueEnum};
use curriculum_vitae::{Asset, AssetType, Assets, Cv, Experience, Techno, Technos};
use grass::Options;
use schemars::{schema::RootSchema, schema_for};
use serde::Serialize;

#[derive(clap::Parser, Debug)]
#[clap(author, version, about, long_about = None)]
struct Cli {
    #[command(subcommand)]
    command: Commands,
}

#[derive(Subcommand, Debug)]
enum Commands {
    Schema {
        #[arg(value_enum)]
        schema: Schemas,
    },
    Build {
        file_path: PathBuf,
    },
}

// TODO: move logic to Cv struct
fn build(file_path: &PathBuf) -> Result<()> {
    let cv = Cv::from_yaml(file_path)?;

    let technos = Technos::from_yaml(&"data/technos.yml".into())?;

    let address = mustache::compile_path("src/tpl/address.html.mu")? //
        .render_to_string(&cv.contact)?;

    let info = mustache::compile_path("src/tpl/info.html.mu")? //
        .render_to_string(&cv.get_info()?)?;

    // TODO: move to Experience struct
    #[derive(Serialize)]
    struct ExperienceData<'a> {
        experience: &'a Experience,
        period: String,
        technos: Vec<Techno>,
    }

    // TODO: move to Experience struct
    let experiences_technos: Vec<ExperienceData> = cv
        .experiences
        .0
        .iter()
        .map(|experience| ExperienceData {
            experience,
            period: experience.period.to_string(),
            technos: experience.get_technos(&technos).unwrap(),
        })
        .collect();

    // TODO: move to Experience struct
    let experiences = mustache::compile_path("src/tpl/experiences.html.mu")? //
        .render_to_string(&experiences_technos)?;

    #[derive(Serialize)]
    struct CvData<'a> {
        address: String,
        info: String,
        cv: &'a Cv,
        experiences: String,
    }
    let content_data = CvData {
        address,
        info,
        cv: &cv,
        experiences,
    };
    let content = mustache::compile_path("src/tpl/cv.html.mu")? //
        .render_to_string(&content_data)?;

    let style = format!(
        "<style>{}</style>",
        grass::from_path("src/scss/main.scss", &Options::default())?
    );

    let assets = Assets::from_yaml(&"data/assets.yml".into())?;
    let stylesheets = assets.get_by_asset_type(AssetType::Css);
    let scripts = assets.get_by_asset_type(AssetType::Javascript);

    #[derive(Serialize)]
    struct IndexData<'a> {
        gtag: &'a String,
        content: String,
        scripts: Vec<&'a Asset>,
        stylesheets: Vec<&'a Asset>,
        style: String,
    }
    let index_data = IndexData {
        content,
        gtag: &cv.gtag,
        scripts,
        stylesheets,
        style,
    };
    let index = mustache::compile_path("src/tpl/index.html.mu")? //
        .render_to_string(&index_data)?;
    println!("{index}");

    Ok(())
}

#[derive(Debug, Clone, ValueEnum)]
enum Schemas {
    Cv,
    Assets,
    Technos,
}

impl Schemas {
    fn get_schema(&self) -> RootSchema {
        match self {
            Self::Cv => schema_for!(Cv),
            Self::Assets => schema_for!(Assets),
            Self::Technos => schema_for!(Technos),
        }
    }
}

fn schema_string(schema: &Schemas) -> Result<()> {
    println!("{}", serde_json::to_string_pretty(&schema.get_schema())?);

    Ok(())
}

fn main() -> Result<()> {
    let cli = Cli::parse();

    match &cli.command {
        Commands::Build { file_path } => build(file_path)?,
        Commands::Schema { schema } => schema_string(schema)?,
    };

    Ok(())
}
