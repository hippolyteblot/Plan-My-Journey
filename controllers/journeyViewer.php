<?php

require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');
require_once(PATH_MODELS . 'actionJourney.php');



$journey = new Journey($_GET['id']);
if($journey->getCreator() != $_SESSION['id'] && !$journey->isPublic()) {
    header('Location: index.php?page=home');
}
if(array_key_exists('share', $_POST)) {
    setJourneyPublic($_GET['id']);
}
if(array_key_exists('private', $_POST)) {
    setJourneyPrivate($_GET['id']);
}
if(array_key_exists('delete', $_POST)) {
    deleteJourney($_GET['id']);
}
if(array_key_exists('modify', $_POST)) {
    $steps = $journey->getSteps();
    echo '<pre>'; print_r($steps); echo '</pre>';
    //comparer ca aux steps sur le navigateur
    //si different de la bdd, modifier avec la fonction modifyJourney
    //si pas de difference, ne rien faire
    
}

$pageName = "Parcours";

require_once(PATH_VIEWS . 'journeyViewer.php');