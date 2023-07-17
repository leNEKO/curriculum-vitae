use std::{fs::File, path::PathBuf};

use anyhow::Result;
use schemars::JsonSchema;
use serde::{Deserialize, Serialize};
use url::Url;

#[derive(Deserialize, Serialize, Debug, JsonSchema, PartialEq)]
pub enum AssetType {
    Css,
    Javascript,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Asset {
    name: String,
    url: Url,
    integrity: Option<String>,
    pub asset_type: AssetType,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Assets(pub Vec<Asset>);

impl Assets {
    pub fn from_yaml(path: &PathBuf) -> Result<Self> {
        Ok(serde_yaml::from_reader(File::open(path)?).expect("Invalid path"))
    }

    pub fn get_by_asset_type(&self, asset_type: AssetType) -> Vec<&Asset> {
        self.0
            .iter()
            .filter(|&asset| asset.asset_type == asset_type)
            .collect()
    }
}
