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

  // Array of the primary type id
  $primaryPreferencesId = getPrimaryPreferencesId($primaryPreferences);

  $secondaryPreferences = array();
  $secondaryPreferences = getSecondaryPreferences($user['email']);

  // Array of the secondary type id
  $secondaryPreferencesId = getSecondaryPreferencesId($secondaryPreferences);

  managePreferencesUpdate($user);

  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=connexion');
}
