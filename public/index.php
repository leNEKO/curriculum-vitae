<?php

declare(strict_types=1);

namespace App\Cv;

setlocale(LC_ALL, 'fr_FR.UTF-8');

$baseDir = \dirname(__DIR__);
$tplDir = "$baseDir/src/tpl";
$dataDir = "$baseDir/data";

require  "$baseDir/vendor/autoload.php";


use App\Cv\Html;
use Symfony\Component\Yaml\Yaml;

$html = new Html();

$now = new \DateTimeImmutable();

$info = Yaml::parseFile("$dataDir/info.yml");

$info['contact']['age'] = $now->diff(
   new \DateTimeImmutable('@' . $info['contact']['birthday'])
)->y;

$info['contact']['elapsed'] = $now->diff(
   new \DateTimeImmutable('2004-01-01')
)->y;

$info['contact']['dispo'] = $now->add(
   new \DateInterval($info['contact']['dispoDelay'])
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
            $info['contact']
         ),
         "info" => $html->render(
            "$tplDir/info.mu",
            $info['contact']
         ),
         "experiences" => $html->render(
            "$tplDir/experiences.mu",
            $experiences,
         ),
         "url" => "https://docs.google.com/spreadsheets/d/10NMp5EHkIQexaXeaxUbqfIkLK0pt6yrQPe9IZwujdhQ/edit#gid=0",
         "data" => $info
      ]
   )
];

echo $html->page($content);
