<?php

$pageName = "Accueil";

require_once(PATH_MODELS . 'generateJourney.php');

if(maxQueryReached($_SESSION['id'])) {
    $tooMuchQuery = true;
}

require_once(PATH_VIEWS . 'home.php');
