<?php

include_once(PATH_MODELS . 'Connexion.php');

function getUserByToken($token)
{
  $db = Connexion::getInstance()->getBdd();
  $query = $db->prepare("SELECT * FROM user WHERE token = :token");
  $query->execute([
    'token' => $token
  ]);
  return $query->fetch();
}

function newPassword($password, $id)
{
  $password = password_hash($password, PASSWORD_DEFAULT);
  $db = Connexion::getInstance()->getBdd();
  $query = $db->prepare("UPDATE user SET password = :password, token = NULL WHERE user_id = :id");
  $query->execute([
    'password' => $password,
    'id' => $id
  ]);
}
