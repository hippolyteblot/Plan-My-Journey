<?php
require_once(PATH_MODELS . 'Connexion.php');

function insertStepInDatabase($step) {
    $db = $database = Connexion::getInstance()->getBdd();
    if(alreadyExist($step)) {
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

function alreadyExist($step) {
    $db = $database = Connexion::getInstance()->getBdd();

    $query = $db->prepare('SELECT * FROM step WHERE step_id = ?');
    $query->execute([$step["place_id"]]);
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}