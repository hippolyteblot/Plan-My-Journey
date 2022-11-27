<?php

require_once(PATH_MODELS . 'preferences.php');

if(isset($_POST['submitParameters'])) {
    $_SESSION['parameters'] = array(
        'start' => $_POST['timeFrom'],
        'end' => $_POST['timeTo'],
        'budget' => $_POST['budget'],
        'restaurant' => $_POST['restaurant']
    );
} else if(isset($_POST['Y/N'])){
    if($_POST['Y/N'] == 'N'){
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        // $preferences = getPrimaryPreferences($_SESSION['user']) + getSecondaryPreferences($_SESSION['user']);
        $preferences = getPrimaryPreferences($_SESSION['email']);
        $preferences = array_merge($preferences, getSecondaryPreferences($_SESSION['email']));
        // Store the preferences in the session
        $_SESSION['preferences'] = $preferences;
        
        // Redirect to the generateJourney page
        header('Location: ?page=generateJourney');
    }
}
require_once(PATH_VIEWS . 'preferencesSelection.php');