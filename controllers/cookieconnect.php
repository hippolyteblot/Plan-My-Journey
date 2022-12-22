<?php
require_once(PATH_MODELS . 'login.php');

if (!isset($_SESSION['email'])) {
  if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    if (!empty($_COOKIE['email']) && !empty($_COOKIE['password'])) {

      $email = $_COOKIE['email'];
      $password = $_COOKIE['password'];
      $alert = checkAccount($email, $password);
      if (isset($alert['messageAlert'])) {
        $messageAlert = $alert['messageAlert'];
        $classAlert = $alert['classAlert'];
      } else {
        // Save name, firstname and email in session
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $alert['firstname'];
        $_SESSION['lastname'] = $alert['lastname'];
        header('Location: index.php?page=home');
      }
    }
  }
}
