<?php
require_once(PATH_MODELS . 'Connexion.php');

function getAccount($email)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT * FROM user WHERE email = ?');
  $query->execute(array($email));
  $result = $query->fetch();
  return $result;
}

function updateAccount($firstname, $lastname, $email, $password)
{
  if (!emailExists($email) || $_SESSION['email'] == $email) {
    if ($password != null) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $database = Connexion::getInstance()->getBdd();
      $query = $database->prepare('UPDATE user SET firstname = ?, lastname = ?, email = ?, password = ? WHERE email = ?');
      $query->execute(array($firstname, $lastname, $email, $password, $_SESSION['email']));
    } else {
      $database = Connexion::getInstance()->getBdd();
      $query = $database->prepare('UPDATE user SET firstname = ?, lastname = ?, email = ? WHERE email = ?');
      $query->execute(array($firstname, $lastname, $email, $_SESSION['email']));
    }
    return true;
  } else {
    return false;
  }
}
function emailExists($email)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT * FROM user WHERE email = ?');
  $query->execute(array($email));
  $result = $query->fetch();
  return $result;
}
