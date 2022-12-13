<?php

require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');

$journey = new Journey($_GET['id']);
if($journey->getCreator() != $_SESSION['id'] && !$journey->isPublic()) {
    header('Location: index.php?page=home');
}

$pageName = "Parcours";

require_once(PATH_VIEWS . 'journeyViewer.php');