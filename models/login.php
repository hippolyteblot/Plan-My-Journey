<?php

include_once(PATH_MODELS . 'Connexion.php');

// Check if there is an account with the email and the password
function checkAccount($email, $password)
{
    $database = Connexion::getInstance()->getBdd();
    $query = $database->prepare('SELECT * FROM user WHERE email = ?');
    $query->execute(array($email));
    $result = $query->fetch();
    if ($result && password_verify($password, $result['password'])) {
        return $result;
    }
    $alert = [
        'messageAlert' => 'Email ou mot de passe incorrect',
        'classAlert' => 'danger'
    ];
    return $alert;
}
