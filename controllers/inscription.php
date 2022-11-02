<?php
session_start();
require_once(PATH_MODELS . 'register.php');


if (isset($_POST['firstname'])) {
  echo '<script>console.log("test")</script>';
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
  $newsletter = htmlspecialchars($_POST['newsletter']);

  $alert = register($firstname, $lastname, $email, $password, $confirmPassword, $newsletter);

  if (isset($alert['messageAlert'])) {
    $_SESSION['email'] = $email;
    require_once(PATH_VIEWS . $page . '.php');
  } else {
    header('Location: index.php?page=connexion');
  }
} else {
  require_once(PATH_VIEWS . $page . '.php');
}
