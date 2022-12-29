<?php

require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');
require_once(PATH_MODELS . 'actionJourney.php');
require_once(PATH_MODELS . 'commentary.php');



$journey = new Journey($_GET['id']);
if($journey->canSee($_SESSION['id']) == false) {
    header('Location: index.php?page=home');
}
if(array_key_exists('share', $_POST)) {
    $journey->setPublic(true);
}
if(array_key_exists('private', $_POST)) {
    $journey->setPublic(false);
}
if(array_key_exists('delete', $_POST)) {
    $journey->deleteJourney();
}
if(array_key_exists('modify', $_POST)) {
    $journey->modifyJourney($_POST['title'], $_POST['description'], $_POST['selectedArray']);
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
if(array_key_exists('commentary', $_POST)) {
    $commentary = htmlspecialchars($_POST['commentary']);
    $journey->addCommentary($_SESSION['id'], $commentary);
}
if(array_key_exists('deleteCommentary', $_POST)) {
    $journey->deleteCommentary($_POST['commentaryId']);
}
if(array_key_exists('reportCommentary', $_POST)) {
    reportCommentary($_POST['commentaryId']);
}
$pageName = "Parcours";

// Re-load the journey to get the updated data
$journey = new Journey($_GET['id']);
require_once(PATH_VIEWS . 'journeyViewer.php');