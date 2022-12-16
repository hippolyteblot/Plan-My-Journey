<?php
require_once(PATH_MODELS . 'login.php');

if (!isset($_SESSION['email'])) {
  if (isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['id'])) {
    if (!empty($_COOKIE['email']) && !empty($_COOKIE['password'])) {

      $email = $_COOKIE['email'];
      $password = $_COOKIE['password'];
      $id = $_COOKIE['id'];
      $alert = checkAccountCookie($email, $password);
      if (isset($alert['messageAlert'])) {
        $messageAlert = $alert['messageAlert'];
        $classAlert = $alert['classAlert'];
      } else {
        // Save name, firstname and email in session
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $alert['firstname'];
        $_SESSION['lastname'] = $alert['lastname'];
        $_SESSION['id'] = $id;
        header('Location: index.php?page=home');
      }
    }
  }
}
