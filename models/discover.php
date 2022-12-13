<?php

include_once(PATH_MODELS . 'Connexion.php');


function getDiscover()
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('SELECT * FROM journey INNER JOIN place ON journey.place_id = place.place_id WHERE public = true');
  $req->execute();
  $result = $req->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function getCompose($journey_id)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('SELECT step_id FROM compose WHERE journey_id = :journey_id AND isSelected = true');
  $req->execute(
    array(
      'journey_id' => $journey_id
    )
  );
  $result = $req->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function getStep($step_id)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('SELECT * FROM step WHERE step_id = :step_id');
  $req->execute(
    array(
      'step_id' => $step_id
    )
  );
  $result = $req->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}