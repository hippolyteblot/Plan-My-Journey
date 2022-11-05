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
      } elseif (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) { // A faire marcher
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


  // Preferences 
  $preferences = array();
  $preferences = getPreferences($user['email']);

  $preferencesId = array();
  foreach ($preferences as $preference) {
    array_push($preferencesId, $preference['primary_type_id']);
  }

  if (isset($_GET['setPreferences'])) {
    $preferencesByGET = array();
    $preferencesByGET = $_GET['setPreferences'];

    // If number of chars is > 1
    if (strlen($preferencesByGET) > 0) {
      $preferencesByGET = explode(',', $preferencesByGET);
      foreach ($preferencesByGET as $preference) {
        setPreferences($user['email'], $preference);
      }
    }

    header('Location: index.php?page=account');
  }


  if (isset($_GET['unSetPreferences'])) {
    $unSetPreferences = array();
    $unSetPreferences = $_GET['unSetPreferences'];
    $unSetPreferences = explode(',', $unSetPreferences);

    foreach ($unSetPreferences as $unSetPreference) {
      unSetPreferences($user['email'], $unSetPreference);
    }
    header('Location: index.php?page=account');
  }

  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=connexion');
}
