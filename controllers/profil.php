<?php

require_once(PATH_MODELS . 'account.php');
require_once(PATH_MODELS . 'journeyGetter.php');
require_once(PATH_MODELS . 'Journey.php');

$user = getAccountFromId($_GET['user']);
if ($user == null || $user['user_id'] == 0) {
    header('Location: ?page=404');
    exit();
}
$pageName = 'Profile - ' . $user['firstname'] . ' ' . $user['lastname'];
$journeys = getSharedJourneys($user['user_id']);

$nbGeneratedJourneys = getNumberOfGeneratedJourneys($user['user_id']);
$nbSharedJourneys = count($journeys);
$nbSavedJourneys = getNumberOfSavedJourneys($user['user_id']);
$nbRatings = getNumberOfRatings($user['user_id']);
$registrationDate = explode('-', $user['registration_date']);
$registrationDate = $registrationDate[2] . '/' . $registrationDate[1] . '/' . $registrationDate[0];
$nbPreferences = getNumberOfPreferences($user['user_id']);

require_once(PATH_VIEWS . 'profil.php');
