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
