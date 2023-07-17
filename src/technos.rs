use std::{collections::HashMap, fs::File, path::PathBuf};

use anyhow::Result;
use schemars::JsonSchema;
use serde::{Deserialize, Serialize};
use slugify::slugify;
use url::Url;

#[derive(Deserialize, Serialize, Debug, JsonSchema, Hash, Eq, PartialEq)]
pub struct TechnoKey(String);

#[derive(Deserialize, Serialize, Debug, JsonSchema, Clone)]
pub enum TechnoType {
    CODE,
    FORMAT,
    API,
    OS,
    CLI,
    FRAMEWORK,
    SERVICE,
    SOFT,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema, Clone)]
pub struct Techno {
    // key: TechnoKey,
    name: String,
    icon: Option<String>,
    techno_type: TechnoType,
    link: Option<Url>,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Technos(pub HashMap<TechnoKey, Techno>);

impl Technos {
    pub fn from_csv(path: &PathBuf) -> Result<Self> {
        let mut rdr = csv::Reader::from_path(path)?;
        let mut data: HashMap<TechnoKey, Techno> = HashMap::new();
        for result in rdr.deserialize() {
            let techno: Techno = result?;
            data.insert(TechnoKey(slugify!(&techno.name)), techno);
        }

        Ok(Self(data))
    }

    pub fn from_yaml(path: &PathBuf) -> Result<Self> {
        Ok(serde_yaml::from_reader(File::open(path)?).expect("Invalid path"))
    }
}
