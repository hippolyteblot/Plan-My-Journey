<?php

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
  $categories = getCategories();

  // TEST DE LA FONCTION getPreferences()
  $preferences = array();
  $preferences = getPreferences($user['email']);


  // TEST DE LA FONCTION setPreferences()
  if (isset($_GET['setPreferences'])) {
    $preferencesByGET = array();
    $preferencesByGET = $_GET['setPreferences'];
    $preferenceByGET = explode(',', $preferencesByGET);

    foreach ($preferenceByGET as $preference) {
      setPreferences($user['email'], $preference);
    }

    header('Location: index.php?page=account');
  }

  // TEST DE LA FONCTION unSetPreferences()
  if (isset($_GET['unSetPreferences'])) {
    $unSetPreferences = array();
    $unSetPreferences = $_GET['unSetPreferences'];
    $unSetPreferences = explode(',', $unSetPreferences);

    foreach ($unSetPreferences as $unSetPreference) {
      unSetPreferences($user['email'], $unSetPreference);
    }
  }

  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=connexion');
}
