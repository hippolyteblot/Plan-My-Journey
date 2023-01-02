<?php

require_once(PATH_MODELS . 'generateJourney.php');

if(maxQueryReached($_SESSION['id'])) {
    header('Location: index.php?page=home');
}

$pageName = "Génération du parcours";

$tmp = sortPreferences($_SESSION['preferences']);
$activities = $tmp['activities'];
$restaurants = $tmp['restaurants'];

// We build the schema of the journey
$journeySchema = buildSchema($_SESSION['parameters']['start'], $_SESSION['parameters']['end'], 
    $activities, $restaurants, $_SESSION['parameters']['restaurant']);


$journeySchema = getCandidates($journeySchema, $activities, $restaurants, 
    $_SESSION["candidates"][0]["geometry"]["location"]);
$journeySchema = getCandidatesFromJSON("journeySchemaExemple.json");
//$journeySchema = filterFromConstraints($journeySchema, (int) $_SESSION['parameters']["budget"]);

require_once(PATH_VIEWS . 'generateJourney.php');
