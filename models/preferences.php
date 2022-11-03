<?php

function getPrimaryTypes() {
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM primary_type 
        INNER JOIN type_membership ON primary_type.primary_type_id = type_membership.type_id 
        INNER JOIN type_category ON type_membership.category_id = type_category.category_id');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function getCategories() {
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM type_category');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}