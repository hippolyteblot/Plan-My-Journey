<?php

$pageName = "Séléction des préférences";

require_once(PATH_MODELS . 'preferences.php');

if (isset($_SESSION['email'])) {
    $primaryTypes = getPrimaryTypes();
    $secondaryTypes = getSecondaryTypes();
    $categories = getCategories();

    $primaryPreferences = getPrimaryPreferences($_SESSION['email']);

    $secondaryPreferences = getSecondaryPreferences($_SESSION['email']);

    // Array of the primary type id
    $primaryPreferencesId = getPrimaryPreferencesId($primaryPreferences);

    // Array of the secondary type id
    $secondaryPreferencesId = getSecondaryPreferencesId($secondaryPreferences);
}

if (isset($_POST['submitParameters'])) {

    $selectedPlace = null;
    foreach ($_SESSION["candidates"] as $place) {
        // If the formatted address is not in the database
        if ($place["formatted_address"] == $_POST["place"]) {
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
} else if (isset($_POST['Y/N'])) {
    if ($_POST['Y/N'] == 'N') {
        $preferences = getPrimaryPreferences($_SESSION['email']);
        $preferences = array_merge($preferences, getSecondaryPreferences($_SESSION['email']));
        // Store the preferences in the session
        $_SESSION['preferences'] = $preferences;

        // Redirect to the generateJourney page
        header('Location: ?page=generateJourney');
    } else if ($_POST['Y/N'] == 'Y') {
        $preferences = $_GET['preferences'];
        $preferences = explode(',', $preferences);
        $preferencesArrayPrimary = [];
        $preferencesArraySecondary = [];
        foreach ($preferences as $preference) {
            $preferenceArray = getPrimaryPreferencesFromName($preference);
            if ($preferenceArray) {
                array_push($preferencesArrayPrimary, $preferenceArray[0]);
            }
        }
        foreach ($preferences as $preference) {
            $preferenceArray = getSecondaryPreferencesFromName($preference);
            if ($preferenceArray) {
                array_push($preferencesArraySecondary, $preferenceArray[0]);
            }
        }
        $preferencesArray = array_merge($preferencesArrayPrimary, $preferencesArraySecondary);
        $_SESSION['preferences'] = $preferencesArray;

        // Redirect to the generateJourney page
        header('Location: ?page=generateJourney');
    }
}
require_once(PATH_VIEWS . 'preferencesSelection.php');
