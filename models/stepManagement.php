<?php
require_once(PATH_MODELS . 'Connexion.php');

function insertStepInDatabase($step) {
    $db = $database = Connexion::getInstance()->getBdd();
    if(stepAlreadyExist($step)) {
        return true;
    }
    $rating;
    if(isset($step["rating"])) {
        $rating = $step["rating"];
    } else {
        $rating = null;
    }
    $query = $db->prepare('INSERT INTO step (step_id, step_name, step_vicinity, step_lat, step_lng, step_rating) VALUES (?, ?, ?, ?, ?, ?)');
    $result = $query->execute([
        $step["place_id"],
        $step["name"],
        $step["vicinity"],
        $step["geometry"]["location"]["lat"],
        $step["geometry"]["location"]["lng"],
        $rating
    ]);
    return $result;
}

function stepAlreadyExist($step) {
    $db = $database = Connexion::getInstance()->getBdd();

    $query = $db->prepare('SELECT * FROM step WHERE step_id = ?');
    $query->execute([$step["place_id"]]);
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function insertNewPlaceInDatabase($place) {
    $db = $database = Connexion::getInstance()->getBdd();
    if($id = placeAlreadyExist($place)) {
        return $id;
    }
    $query = $db->prepare('INSERT INTO place (place_name, place_fullname, place_lat, place_lng) VALUES (?, ?, ?, ?)');
    $result = $query->execute([
        $place["name"],
        $place["formatted_address"],
        $place["geometry"]["location"]["lat"],
        $place["geometry"]["location"]["lng"]
    ]);
    return $db->lastInsertId();
}

function placeAlreadyExist($place) {
    $db = $database = Connexion::getInstance()->getBdd();

    $query = $db->prepare('SELECT * FROM place WHERE place_fullname = ?');
    $query->execute([$place["formatted_address"]]);
    $result = $query->fetch();
    $query->closeCursor(); 
    return $result["place_id"];
}

function insertNewJourneyInDatabase($journeySchema, $placeId, $userEmail, $budget, $title, $description, $public) {
    $db = $database = Connexion::getInstance()->getBdd();
    $userId = getUserId($userEmail);
    $query = $db->prepare('INSERT INTO journey (user_id, place_id, journey_start, journey_end, journey_budget, description, title, creation_date, public) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)');
    $result = $query->execute([
        $userId,
        $placeId,
        $journeySchema[0]["start"],
        $journeySchema[count($journeySchema) - 1]["end"],
        $budget,
        $description,
        $title,
        $public
    ]);
    return $db->lastInsertId();
}

function getUserId($userEmail) {
    $db = $database = Connexion::getInstance()->getBdd();

    $query = $db->prepare('SELECT user_id FROM user WHERE email = ?');
    $query->execute([$userEmail]);
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result[0]["user_id"];
}

function linkSteptoJourney($journeyId, $stepId, $iSelected, $start, $end, $typeId) {
    $db = $database = Connexion::getInstance()->getBdd();
    if(stepAlreadyLinked($journeyId, $stepId, $start, $end, $typeId)) {
        return true;
    }
    $query = $db->prepare('INSERT INTO compose (journey_id, step_id, type_id, start, end, isSelected) VALUES (?, ?, ?, ?, ?, ?)');
    $result = $query->execute([
        $journeyId,
        $stepId,
        $typeId,
        $start,
        $end,
        $iSelected
    ]);
}

function stepAlreadyLinked($journeyId, $stepId, $start, $end, $typeId) {
    $db = $database = Connexion::getInstance()->getBdd();

    $query = $db->prepare('SELECT * FROM compose WHERE journey_id = ? AND step_id = ? AND start = ? AND end = ? AND type_id = ?');
    $query->execute([$journeyId, $stepId, $start, $end, $typeId]);
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}
