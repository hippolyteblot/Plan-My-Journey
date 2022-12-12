<?php

require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');

$journey = new Journey($_GET['id']);

echo $journey->getPlace();
/*
echo "<pre>";
print_r($journey->getSchema());
echo "</pre>";
*/

$pageName = "Parcours";

require_once(PATH_VIEWS . 'journeyViewer.php');