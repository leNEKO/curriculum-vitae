<?php

declare(strict_types=1);

use App\Cv\CompetenceService;
use App\Cv\Experience;
use App\Cv\ExperienceCollection;
use App\Cv\Periode;
use App\Cv\SheetReader;
use App\Cv\StackCollection;
use App\Cv\TacheCollection;
use Cocur\Slugify\Slugify;

$sheetReader = new SheetReader(
    'https://docs.google.com/spreadsheets/d/e/2PACX-1vRm-k2WN3lyG-5RxFtM2j_dzX46Y1xVVnlJRVGgnCZq53xjoTIg1NpIR8mQQhLm146bM8HZT7HGEu4K/pub?gid=0&single=true&output=csv',
    true,
);

$competenceService = new CompetenceService(
    $sheetReader->read(),
    new Slugify(),
);

$experiences = new ExperienceCollection(
    [
        new Experience(
            periode: Periode::fromAtomStrings('2022-11-01', '2023-06-10'),
            poste: "Tech Lead",
            entreprise: "Marjory",
            tacheCollection: new TacheCollection(
                [
                    "Développement microservice serverless",
                    "Gestion déploiement release, CI/CD",
                    "Maintenance, gestion incidents",
                    "Tooling / scripting",
                ]
            ),
            stackCollection: new StackCollection(
                [
                    $competenceService->getByName('serverless'),
                    $competenceService->getByName('jest'),
                    $competenceService->getByName('typescript'),
                    $competenceService->getByName('python'),
                    $competenceService->getByName('rust'),
                    $competenceService->getByName('nodejs'),
                    $competenceService->getByName('dynamodb'),
                    $competenceService->getByName('gitlab'),
                    $competenceService->getByName('algolia'),
                    $competenceService->getByName('docker'),
                    $competenceService->getByName('git'),
                    $competenceService->getByName('shell'),
                    $competenceService->getByName('linux'),
                    $competenceService->getByName('aws'),
                ]
            )
        ),
        new Experience(
            periode: Periode::fromAtomStrings("2018-01-01", "2022-01-01"),
            poste: 'Développeur Backend Senior',
            entreprise: 'Wizaplace',
            tacheCollection: new TacheCollection(
                [
                    'Maintenance applicative',
                    "Benchmarking / améliorations des performances de l'application.",
                    'Développement de features',
                    'Tooling / scripting',
                    'Reprise de données / ETL',
                    'Patch management / maj sécurité',
                ]
            ),
            stackCollection: new StackCollection(
                [
                    $competenceService->getByName('symfony'),
                    $competenceService->getByName('phpunit'),
                    $competenceService->getByName('php'),
                    $competenceService->getByName('python'),
                    $competenceService->getByName('mysql'),
                    $competenceService->getByName('redis'),
                    $competenceService->getByName('sqs'),
                    $competenceService->getByName('nginx'),
                    $competenceService->getByName('amqp'),
                    $competenceService->getByName('docker'),
                    $competenceService->getByName('blackfire'),
                    $competenceService->getByName('algolia'),
                    $competenceService->getByName('git'),
                    $competenceService->getByName('shell'),
                    $competenceService->getByName('linux'),
                    $competenceService->getByName('aws'),
                ]
            )
        ),
        new Experience(
            periode: Periode::fromAtomStrings('2008-01-01', '2018-01-01'),
            poste: 'Développeur Fullstack',
            entreprise: 'Hurleur Média',
            tacheCollection: new TacheCollection(
                [
                    "Conception, développement, déploiement, intégration d'une plateforme d'eCommerce",
                    "Conception, développement, déploiement, intégration d'une plateforme CMS",
                    "Administration de serveurs Linux dédiés et virtualisés",
                ]
            ),
            stackCollection: new StackCollection(
                [
                    $competenceService->getByName('php'),
                    $competenceService->getByName('mysql'),
                    $competenceService->getByName('apache'),
                    $competenceService->getByName('unison'),
                    $competenceService->getByName('shell'),
                    $competenceService->getByName('linux'),
                ]
            )
        ),
        new Experience(
            periode: Periode::fromAtomStrings('2004-01-01T00:00:00', '2008-01-01T00:00:00'),
            poste: 'Développeur Flash/Actionscript',
            entreprise: 'Indépendant',
            tacheCollection: new TacheCollection(
                [
                    'Créations de site dynamique avec la plateforme Flash / ActionScript',
                    'Applications interactives multimédia',
                ]
            ),
            stackCollection: new StackCollection(
                [
                    $competenceService->getByName('actionscript'),
                    $competenceService->getByName('php'),
                    $competenceService->getByName('mysql'),
                    $competenceService->getByName('apache'),
                    $competenceService->getByName('flash'),
                ]
            ),
        ),
    ]
);

return $experiences;
