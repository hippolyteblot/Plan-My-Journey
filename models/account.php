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
function getAccountFromId($id)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT * FROM user WHERE user_id = ?');
  $query->execute(array($id));
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

function deleteAccount($id){
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('DELETE FROM user WHERE user_id = ?');
  $query->execute(array($id));
  //suprrimer les parcours générés
  $query = $database->prepare('DELETE FROM journey WHERE user_id = ?');
  $query->execute(array($id));
  //supprimer les parcours sauvegardés
  $query = $database->prepare('DELETE FROM save WHERE user_id = ?');
  $query->execute(array($id));
  //supprimer les parcours favoris
  $query = $database->prepare('DELETE FROM favorite WHERE user_id = ?');
  $query->execute(array($id));
  //supprimer les notes
  $query = $database->prepare('DELETE FROM rating WHERE user_id = ?');
  $query->execute(array($id));
  $query = $database->prepare('DELETE FROM commentary WHERE user_id = ?');
  $query->execute(array($id));
  $query = $database->prepare('DELETE FROM secondary_preferences WHERE user_id = ?');
  $query->execute(array($id));
  $query = $database->prepare('DELETE FROM primary_preferences WHERE user_id = ?');
  $query->execute(array($id));
  
}

function getId(){
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT user_id FROM user WHERE email = ?');
  $query->execute(array($_SESSION['email']));
  $result = $query->fetch();
  return $result['user_id'];
}
function getNumberOfGeneratedJourneys($userId)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT COUNT(*) FROM journey WHERE user_id = ?');
  $query->execute(array($userId));
  $result = $query->fetch();
  return $result[0];
}

function getNumberOfSavedJourneys($userId)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT COUNT(*) FROM save WHERE user_id = ?');
  $query->execute(array($userId));
  $result = $query->fetch();
  return $result[0];
}

function getNumberOfRatings($userId)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT COUNT(*) FROM rating WHERE user_id = ?');
  $query->execute(array($userId));
  $result = $query->fetch();
  return $result[0];
}

function getNumberOfPreferences($userId)
{
  $database = Connexion::getInstance()->getBdd();
  $query = $database->prepare('SELECT COUNT(*) FROM primary_preferences WHERE user_id = ?');
  $query->execute(array($userId));
  $result = $query->fetch();
  $count = $result[0];
  $query = $database->prepare('SELECT COUNT(*) FROM secondary_preferences WHERE user_id = ?');
  $query->execute(array($userId));
  $result = $query->fetch();
  $count += $result[0];
  return $count;
}
