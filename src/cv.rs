use core::fmt;
use std::{fs::File, path::PathBuf};

use anyhow::{Context, Result};
use chrono::{Datelike, Months, NaiveDate, Utc};
use schemars::JsonSchema;
use serde::{Deserialize, Serialize};
use url::Url;

use crate::{Techno, TechnoKey, Technos};

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Entry {
    title: String,
    comment: Option<String>,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema, Clone)]
pub struct JobTitle(String);

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Education {
    formations: Vec<Entry>,
    languages: Vec<Entry>,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Address {
    cp: String,
    city: String,
    gmap: Url,
    street: String,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Contact {
    firstname: String,
    lastname: String,
    email: String, // TODO: Email type
    website: Url,
    github: Url,
    phone: Option<String>,
    birthday: NaiveDate,
    career_start: NaiveDate,
    avalaible_date: Option<NaiveDate>,
    dispo_delay: Option<u8>, // in months
    job_title: JobTitle,
    address: Address,
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Period {
    start: NaiveDate,
    end: NaiveDate,
}

impl fmt::Display for Period {
    fn fmt(&self, f: &mut fmt::Formatter) -> fmt::Result {
        write!(f, "{} - {}", self.start.year(), self.end.year())
    }
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Task(String);

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Experience {
    pub period: Period,
    job_title: JobTitle,
    company: String,
    tasks: Vec<Task>,
    technos: Vec<TechnoKey>,
}

impl Experience {
    pub fn get_technos(&self, technos: &Technos) -> Result<Vec<Techno>> {
        let mut results: Vec<Techno> = Vec::new();
        for key in &self.technos {
            let techno = technos.0.get(key).context("not found")?;
            results.push(techno.clone());
        }

        Ok(results)
    }
}

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Experiences(pub Vec<Experience>);

#[derive(Deserialize, Serialize, Debug, JsonSchema)]
pub struct Cv {
    pub gtag: String,
    pub contact: Contact,
    pub education: Education,
    pub experiences: Experiences,
}

#[derive(Deserialize, Serialize, Debug)]
pub struct Info {
    job_title: JobTitle,
    available_date: Option<String>,
    elapsed: u32, // years
}

impl Cv {
    pub fn from_yaml(path: &PathBuf) -> Result<Self> {
        Ok(serde_yaml::from_reader(File::open(path)?).expect("Invalid path"))
    }

    pub fn get_info(&self) -> Result<Info> {
        let now = Utc::now().date_naive();
        let elapsed = now.years_since(self.contact.career_start).unwrap();

        let available_date = match self.contact.avalaible_date {
            Some(d) => Some(d),
            None => now.checked_add_months(Months::new(self.contact.dispo_delay.unwrap().into())),
        };

        Ok(Info {
            job_title: self.contact.job_title.clone(),
            available_date: available_date.map(|d| d.format("%B %Y").to_string()),
            elapsed,
        })
    }
}
