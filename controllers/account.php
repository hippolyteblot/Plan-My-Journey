<?php
session_start();
require_once(PATH_MODELS . 'account.php');

if (isset($_SESSION['email'])) {
  $user = getAccount($_SESSION['email']);
  require_once(PATH_VIEWS . 'account.php');
} else {
  header('Location: index.php?page=connexion');
}
