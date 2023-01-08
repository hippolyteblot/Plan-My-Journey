<?php

$pageName = "Accueil";

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {

    require_once(PATH_MODELS . 'generateJourney.php');
    require_once(PATH_MODELS . 'account.php');

    if(maxQueryReached($_SESSION['id'])) {
        $tooMuchQuery = true;
    }

    if(getNumberOfActivities($_SESSION['id']) < 10 || getNumberOfRestaurants($_SESSION['id']) < 5) {
        $notEnoughActivities = true;
    }

    require_once(PATH_VIEWS . 'home.php');

} else {
    
        require_once(PATH_VIEWS . 'presentation.php');
}