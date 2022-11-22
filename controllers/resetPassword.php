<?php
$pageName = "Nouveau mot de passe";

require_once(PATH_MODELS . 'resetPassword.php');

if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $user = getUserByToken($token);
  if ($user) {
    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];
      if ($password === $confirmPassword) {
        newPassword($password, $user['user_id']);

        header('Location: ?page=login');
      } else {
        $alert = "Les mots de passe ne correspondent pas";
      }
    }
  } else {
    header('Location: ?page=login');
  }
  require_once(PATH_VIEWS . 'resetPassword.php');
} else {
  require_once(PATH_VIEWS . 'forgotPassword.php');
}
