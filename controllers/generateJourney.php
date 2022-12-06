<?php

require_once(PATH_MODELS . 'generateJourney.php');

$pageName = "Génération du parcours";

$tmp = sortPreferences($_SESSION['preferences']);
$activities = $tmp['activities'];
$restaurants = $tmp['restaurants'];

// We build the schema of the journey
$journeySchema = buildSchema($_SESSION['parameters']['start'], $_SESSION['parameters']['end'], $activities, $restaurants);


//$journeySchema = getCandidates($journeySchema, $activities, $restaurants, $_SESSION["candidates"][0]["geometry"]["location"]);
$journeySchema = getCandidatesFromJSON("journeySchemaExemple.json");

require_once(PATH_VIEWS . 'generateJourney.php');

// Display all err
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);