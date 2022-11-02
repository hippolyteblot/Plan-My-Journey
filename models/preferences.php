<?php

function getPrimaryTypes() {
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM primary_type');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}
