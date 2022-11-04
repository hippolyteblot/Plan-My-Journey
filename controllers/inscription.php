<?php

$pageName = "Inscription";

require_once(PATH_MODELS . 'register.php');


if (isset($_POST['firstname'])) {
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

  if(isset($_POST['newsletter'])) {
    $newsletter = "on";
  } else {
    $newsletter = '';
  }

  $alert = register($firstname, $lastname, $email, $password, $confirmPassword, $newsletter);

  if (isset($alert['messageAlert'])) {
    require_once(PATH_VIEWS . $page . '.php');
  } else {
    header('Location: index.php?page=connexion');
  }
} else {
  require_once(PATH_VIEWS . $page . '.php');
}
