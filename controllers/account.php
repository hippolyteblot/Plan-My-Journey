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

  // Informations
  if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['password_confirm']);
    $alert = array();

    if (empty($firstname) || empty($lastname) || empty($email)) {
      $alert['empty'] = "Tous les champs doivent être remplis";
    }

    if (!empty($password) || !empty($passwordConfirm)) {
      if ($password != $passwordConfirm) {
        $alert['password'] = "Les mots de passe ne correspondent pas";
      } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
        $alert['password'] = "Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 minuscule et 1 chiffre";
      }
    }


    if (empty($alert)) {
      $result = updateAccount($firstname, $lastname, $email, $password);
      if ($result) {
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        header('Location: index.php?page=account');
      } else {
        $alert['email'] = "Cet email est déjà utilisé";
      }
    }
  }

  $primaryPreferences = array();
  $primaryPreferences = getPrimaryPreferences($user['email']);

  // Array of the primary type id
  $primaryPreferencesId = getPrimaryPreferencesId($primaryPreferences);

  $secondaryPreferences = array();
  $secondaryPreferences = getSecondaryPreferences($user['email']);

  // Array of the secondary type id
  $secondaryPreferencesId = getSecondaryPreferencesId($secondaryPreferences);

  managePreferencesUpdate($user);

  if (isset($_SESSION['goToGen']) && $_SESSION['goToGen'] == true) {

    if (isset($_POST['confirm']) && $_POST['confirm'] == 'Y') {

      $preferences = getPrimaryPreferences($_SESSION['email']);
      $preferences = array_merge($preferences, getSecondaryPreferences($_SESSION['email']));
      // Store the preferences in the session
      $_SESSION['preferences'] = $preferences;

      $_SESSION['goToGen'] = false;

      header('Location: index.php?page=generateJourney');
    }
  }

  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=login');
}
