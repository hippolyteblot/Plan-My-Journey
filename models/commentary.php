<?php

require_once(PATH_MODELS . 'Connexion.php');

function reportCommentary($commentaryId) {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("UPDATE commentary SET is_reported = 1 WHERE commentary_id = :id");
    $query->execute([
        'id' => $commentaryId
    ]);
}

function unreportCommentary($commentaryId) {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("UPDATE commentary SET is_reported = 0 WHERE commentary_id = :id");
    $query->execute([
        'id' => $commentaryId
    ]);
}

function deleteCommentary($commentaryId) {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare("DELETE FROM commentary WHERE commentary_id = :id");
    $query->execute([
        'id' => $commentaryId
    ]);
}

function getReportedCommentaries() {
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM commentary 
        INNER JOIN user ON commentary.user_id = user.user_id
        WHERE is_reported = 1');
    $query->execute();
    return $query->fetchAll();
}