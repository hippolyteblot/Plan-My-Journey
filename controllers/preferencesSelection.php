<?php

require_once(PATH_MODELS . 'preferences.php');


if(isset($_POST['submitParameters'])) {

    $selectedPlace = null;
    foreach($_SESSION["candidates"] as $place){
        // If the formatted address is not in the database
        if($place["formatted_address"] == $_POST["place"]){
            $selectedPlace = $place;
        }
    }
    // Strinify the selected place
    $selectedPlace = json_encode($selectedPlace);

    $_SESSION['parameters'] = array(
        'start' => $_POST['timeFrom'],
        'end' => $_POST['timeTo'],
        'budget' => $_POST['budget'],
        'restaurant' => $_POST['restaurant'],
        'place' => $selectedPlace
    );
} else if(isset($_POST['Y/N'])){
    if($_POST['Y/N'] == 'N'){
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