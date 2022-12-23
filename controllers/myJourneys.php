<?php

$pageName = "Mes parcours";

require_once(PATH_MODELS.'Journey.php');
require_once(PATH_MODELS.'journeyGetter.php');

$generatedJourneys = getGeneratedJourneys($_SESSION['id']);
$savedJourneys = getSavedJourneys($_SESSION['id']);

echo(Journey::calculateEachDistance($savedJourneys[0]->getSteps()) . "km");

require_once(PATH_VIEWS.'myJourneys.php');