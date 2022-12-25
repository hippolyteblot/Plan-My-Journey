<?php

$pageName = "Mes parcours";

require_once(PATH_MODELS.'Journey.php');
require_once(PATH_MODELS.'journeyGetter.php');

$favoriteJourneys = getFavoriteJourneys($_SESSION['id']);
$generatedJourneys = getGeneratedJourneys($_SESSION['id']);
$savedJourneys = getSavedJourneys($_SESSION['id']);


require_once(PATH_VIEWS.'myJourneys.php');