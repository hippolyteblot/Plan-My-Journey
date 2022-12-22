<?php

require_once(PATH_MODELS . 'Connexion.php');

function getGeneratedJourneys($id) {
    // Return only the id of the generated journeys
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("SELECT journey_id FROM journey WHERE user_id = :id");
    $query->execute([
        'id' => $id
    ]);
    $journeys = $query->fetchAll();
    foreach ($journeys as $key => $journey) {
        $journeys[$key] = new Journey($journey['journey_id']);
    }
    return $journeys;
}

function getSavedJourneys($id) {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("SELECT journey_id FROM save WHERE user_id = :id");
    $query->execute([
        'id' => $id
    ]);
    $journeys = $query->fetchAll();
    foreach ($journeys as $key => $journey) {
        $journeys[$key] = new Journey($journey['journey_id']);
    }
    return $journeys;
}

function getSharedJourneys($id) {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("SELECT journey_id FROM journey WHERE user_id = :id AND public = 1");
    $query->execute([
        'id' => $id
    ]);
    $journeys = $query->fetchAll();
    foreach ($journeys as $key => $journey) {
        $journeys[$key] = new Journey($journey['journey_id']);
    }
    return $journeys;
}