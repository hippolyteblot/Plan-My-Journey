<?php
$pageName = "Mot de passe oublié";

require_once(PATH_MODELS . 'forgotPassword.php');

if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $alert = sendMail($email);
  if (isset($alert['messageAlert'])) {
    $messageAlert = $alert['messageAlert'];
    $classAlert = $alert['classAlert'];
  } else {
    header('Location: index.php?page=login');
  }
}

require_once(PATH_VIEWS . 'forgotPassword.php');
