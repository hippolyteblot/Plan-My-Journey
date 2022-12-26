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
if(array_key_exists('notationBtn', $_POST)) {
    $notation = $_POST['notation'];
    $journey->setNotation($notation, $_SESSION['id']);
}
if(array_key_exists('save', $_POST)) {
    $journey->saveJourney($_SESSION['id']);
}
if(array_key_exists('unsave', $_POST)) {
    $journey->unsaveJourney($_SESSION['id']);
}
if(array_key_exists('favorite', $_POST)) {
    if(!$journey->alreadySaved($_SESSION['id']) && $journey->getCreator() != $_SESSION['id'])
        $journey->saveJourney($_SESSION['id']);
    if($journey->alreadyFavorite($_SESSION['id']))
        $journey->removeFavorite($_SESSION['id']);
    else
        $journey->addFavorite($_SESSION['id']);
}
$pageName = "Parcours";

// Re-load the journey to get the updated data
$journey = new Journey($_GET['id']);
require_once(PATH_VIEWS . 'journeyViewer.php');