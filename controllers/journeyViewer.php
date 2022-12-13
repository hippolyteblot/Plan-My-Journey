<?php

require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');

$journey = new Journey($_GET['id']);


$pageName = "Parcours";

require_once(PATH_VIEWS . 'journeyViewer.php');