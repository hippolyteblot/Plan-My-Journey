<?php

require_once(PATH_MODELS . 'Connexion.php');

function getTypeName($typeId)
{
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM primary_type WHERE primary_type_id = ?');
    $query->execute(array($typeId));
    $result = $query->fetch();
    $query->closeCursor();
    // If FALSE, it means that the type is a secondary type
    if (!$result) {
        $query = $db->prepare('SELECT * FROM secondary_type WHERE secondary_type_id = ?');
        $query->execute(array($typeId));
        $result = $query->fetch();
        $query->closeCursor();
    }
    return $result;
}