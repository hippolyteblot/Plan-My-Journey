<?php

$pageName = "Mon compte";

require_once(PATH_MODELS . 'account.php');
require_once(PATH_MODELS . 'preferences.php');

include_once(PATH_CONTROLLERS . 'cookieconnect.php');

if (isset($_SESSION['email'])) {
  $user = array(
    'firstname' => $_SESSION['firstname'],
    'lastname' => $_SESSION['lastname'],
    'email' => $_SESSION['email']
  );
  $primaryTypes = getPrimaryTypes();
  $secondaryTypes = getSecondaryTypes();
  $categories = getCategories();

  // TEST DE LA FONCTION getPreferences()
  $primaryPreferences = array();
  $primaryPreferences = getPrimaryPreferences($user['email']);

  // Array of the primary type name
  $primaryPreferencesId = array();
  foreach ($primaryPreferences as $preference) {
    array_push($primaryPreferencesId, $preference['primary_type_id']);
  }

  $secondaryPreferences = array();
  $secondaryPreferences = getSecondaryPreferences($user['email']);

  // Array of the secondary type name
  $secondaryPreferencesId = array();
  foreach ($secondaryPreferences as $preference) {
    array_push($secondaryPreferencesId, $preference['secondary_type_id']);
  }


  // TEST DE LA FONCTION setPreferences()
  if (isset($_GET['setPreferences'])) {
    $preferencesByGET = array();
    $preferencesByGET = $_GET['setPreferences'];

    // If number of chars is > 1
    if(strlen($preferencesByGET) > 0) {
      $preferencesByGET = explode(',', $preferencesByGET);
      foreach ($preferencesByGET as $preference) {
        setPrimaryPreferences($user['email'], $preference);
      }
    }

    header('Location: index.php?page=account');
  }

  // TEST DE LA FONCTION unSetPreferences()
  if (isset($_GET['unSetPreferences'])) {
    $unSetPreferences = array();
    $unSetPreferences = $_GET['unSetPreferences'];
    $unSetPreferences = explode(',', $unSetPreferences);

    foreach ($unSetPreferences as $unSetPreference) {
      unSetPrimaryPreferences($user['email'], $unSetPreference);
    }
    header('Location: index.php?page=account');
  }

  // TEST DE LA FONCTION setSecondaryPreferences()
  if (isset($_GET['setSecondaryPreferences'])) {
    $secondaryPreferencesByGET = array();
    $secondaryPreferencesByGET = $_GET['setSecondaryPreferences'];

    // If number of chars is > 1
    if(strlen($secondaryPreferencesByGET) > 0) {
      $secondaryPreferencesByGET = explode(',', $secondaryPreferencesByGET);
      foreach ($secondaryPreferencesByGET as $secondaryPreference) {
        setSecondaryPreferences($user['email'], $secondaryPreference);
      }
    }

    header('Location: index.php?page=account');
  }

  // TEST DE LA FONCTION unSetSecondaryPreferences()
  if (isset($_GET['unSetSecondaryPreferences'])) {
    $unSetSecondaryPreferences = array();
    $unSetSecondaryPreferences = $_GET['unSetSecondaryPreferences'];
    $unSetSecondaryPreferences = explode(',', $unSetSecondaryPreferences);

    foreach ($unSetSecondaryPreferences as $unSetSecondaryPreference) {
      unSetSecondaryPreferences($user['email'], $unSetSecondaryPreference);
    }
    header('Location: index.php?page=account');
  }


  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=connexion');
}
