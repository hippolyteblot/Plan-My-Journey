<?php

function getPrimaryTypes()
{
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM primary_type 
        INNER JOIN type_membership ON primary_type.primary_type_id = type_membership.type_id 
        INNER JOIN type_category ON type_membership.category_id = type_category.category_id');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function getSecondaryTypes()
{
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM secondary_type 
        INNER JOIN type_membership ON secondary_type.secondary_type_id = type_membership.type_id 
        INNER JOIN type_category ON type_membership.category_id = type_category.category_id');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function getCategories()
{
    $db = $database = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM type_category');
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function getPrimaryPreferences($user)
{
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM primary_preferences 
    INNER JOIN primary_type ON primary_type.primary_type_id = primary_preferences.primary_type_id 
    INNER JOIN user ON user.user_id = primary_preferences.user_id
    INNER JOIN type_membership ON type_membership.type_id = primary_type.primary_type_id
    INNER JOIN type_category ON type_category.category_id = type_membership.category_id
    WHERE user.email = ?');
    $query->execute(array($user));
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function getSecondaryPreferences($user)
{
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT * FROM secondary_preferences
    INNER JOIN secondary_type ON secondary_type.secondary_type_id = secondary_preferences.secondary_type_id
    INNER JOIN user ON user.user_id = secondary_preferences.user_id
    INNER JOIN type_membership ON type_membership.type_id = secondary_type.secondary_type_id
    INNER JOIN type_category ON type_category.category_id = type_membership.category_id
    WHERE user.email = ?');
    $query->execute(array($user));
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}

function setPrimaryPreferences($user, $preferences)
{
    if (!primaryPreferencesIn($user, $preferences)) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare('SELECT user_id FROM user WHERE email = ?');
        $query->execute(array($user));
        $userId = $query->fetch();
        $userId = $userId['user_id'];
        $query = $db->prepare('INSERT INTO primary_preferences (user_id, primary_type_id) VALUES (?, ?)');
        $query->execute(array($userId, $preferences));
        $query->closeCursor();
    }
}

function setSecondaryPreferences($user, $preferences)
{
    if (!secondaryPreferencesIn($user, $preferences)) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare('SELECT user_id FROM user WHERE email = ?');
        $query->execute(array($user));
        $userId = $query->fetch();
        $userId = $userId['user_id'];
        $query = $db->prepare('INSERT INTO secondary_preferences (user_id, secondary_type_id) VALUES (?, ?)');
        $query->execute(array($userId, $preferences));
        $query->closeCursor();
    }
}

function unSetPrimaryPreferences($user, $preferences)
{
    if (primaryPreferencesIn($user, $preferences)) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare('SELECT user_id FROM user WHERE email = ?');
        $query->execute(array($user));
        $userId = $query->fetch();
        $userId = $userId['user_id'];
        $query = $db->prepare('DELETE FROM primary_preferences WHERE user_id = ? AND primary_type_id = ?');
        $query->execute(array($userId, $preferences));
        $query->closeCursor();
    }
}

function unSetSecondaryPreferences($user, $preferences)
{
    if (secondaryPreferencesIn($user, $preferences)) {
        $db = Connexion::getInstance()->getBdd();
        $query = $db->prepare('SELECT user_id FROM user WHERE email = ?');
        $query->execute(array($user));
        $userId = $query->fetch();
        $userId = $userId['user_id'];
        $query = $db->prepare('DELETE FROM secondary_preferences WHERE user_id = ? AND secondary_type_id = ?');
        $query->execute(array($userId, $preferences));
        $query->closeCursor();
    }
}

function primaryPreferencesIn($user, $preference)
{
    echo $user;
    echo $preference;
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT primary_preferences.primary_type_id FROM primary_preferences
    INNER JOIN primary_type ON primary_type.primary_type_id = primary_preferences.primary_type_id
    INNER JOIN user ON user.user_id = primary_preferences.user_id
    WHERE user.email = ? AND primary_preferences.primary_type_id = ?');
    $query->execute(array($user, $preference));
    $result = $query->fetch();
    $query->closeCursor();
    if ($result) { // Si la préférence existe déjà
        return true;
    } else {
        return false;
    }
}

function secondaryPreferencesIn($user, $preference)
{
    $db = Connexion::getInstance()->getBdd();
    $query = $db->prepare('SELECT secondary_preferences.secondary_type_id FROM secondary_preferences
    INNER JOIN secondary_type ON secondary_type.secondary_type_id = secondary_preferences.secondary_type_id
    INNER JOIN user ON user.user_id = secondary_preferences.user_id
    WHERE user.email = ? AND secondary_preferences.secondary_type_id = ?');
    $query->execute(array($user, $preference));
    $result = $query->fetch();
    $query->closeCursor();
    if ($result) { // Si la préférence existe déjà
        return true;
    } else {
        return false;
    }
}