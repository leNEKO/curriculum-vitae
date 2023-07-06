<?php

declare(strict_types=1);

namespace App\Cv;

setlocale(LC_ALL, 'fr_FR.UTF-8');

$baseDir = \dirname(__DIR__);
$tplDir = "$baseDir/src/tpl";
$dataDir = "$baseDir/data";

require  "$baseDir/vendor/autoload.php";

use App\Cv\Helper;
use App\Cv\Html;

$html = new Html();

$now = new \DateTimeImmutable();

$info = Helper::jsonRead("$dataDir/info.json");
$info->age = $now->diff(
   new \DateTimeImmutable($info->birthday)
)->y;

$info->elapsed = $now->diff(
   new \DateTimeImmutable('2004-01-01')
)
   ->y;

$info->dispo = $now->add(
   \DateInterval::createFromDateString($info->dispo_delay)
)->format("F Y");


/**
 * @var ExperienceCollection
 */
$experiences = require("$dataDir/experiences.php");

$content = [
   $html->render(
      "$tplDir/cv.mu",
      [
         "adresse" => $html->render(
            "$tplDir/adresse.mu",
            $info
         ),
         "info" => $html->render(
            "$tplDir/info.mu",
            $info
         ),
         "experiences" => $html->render(
            "$tplDir/experiences.mu",
            $experiences,
         ),
         "url" => "https://docs.google.com/spreadsheets/d/10NMp5EHkIQexaXeaxUbqfIkLK0pt6yrQPe9IZwujdhQ/edit#gid=0"
      ]
   )
];

echo $html->page($content);
