<?php

include_once(PATH_MODELS . 'Connexion.php');


function setJourneyPublic($id)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('UPDATE journey SET public = 1 WHERE journey_id = :id');
  $req->execute(
    array(
      'id' => $id
    )
  );
}

function setJourneyPrivate($id)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('UPDATE journey SET public = 0 WHERE journey_id = :id');
  $req->execute(
    array(
      'id' => $id
    )
  );
}

function deleteJourney($id)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('DELETE FROM journey WHERE journey_id = :id');
  $req->execute(
    array(
      'id' => $id
    )
  );
}

function modifyJourney($id,$newStep,$oldStep)
{
  $bdd = Connexion::getInstance()->getBdd();
  $req = $bdd->prepare('UPDATE journey SET step = :newStep WHERE journey_id = :id AND step = :oldStep');
  $req->execute(
    array(
      'id' => $id,
      'newStep' => $newStep,
      'oldStep' => $oldStep
    )
  );
}