<?php

$pageName = "Accueil";

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {

    require_once(PATH_MODELS . 'generateJourney.php');

    if(maxQueryReached($_SESSION['id'])) {
        $tooMuchQuery = true;
    }

    require_once(PATH_VIEWS . 'home.php');

} else {
    
        require_once(PATH_VIEWS . 'presentation.php');
}