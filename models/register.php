<?php
require_once(PATH_MODELS . 'Connexion.php');

// Check if the email is already used
function checkEmail($email)
{
    $database = Connexion::getInstance()->getBdd();
    $query = $database->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($email));
    $result = $query->fetch();
    return $result;
}

// Check validity of every field
function checkValidity($firstname, $lastname, $email, $password, $confirmPassword)
{
    $alert = [];

    if (empty($firstname)) {
        $alert['messageAlert'] = 'Veuillez renseigner votre prénom';
    } else if (empty($lastname)) {
        $alert['messageAlert'] = 'Veuillez renseigner votre nom';
    } else if (empty($email)) {
        $alert['messageAlert'] = 'Veuillez renseigner votre email';
    }
    // Check if the email is an email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert['messageAlert'] = 'Veuillez renseigner un email valide';
    }
    // Check if the email is already used
    // else if (checkEmail($email)) {                               À FAIRE MARCHER
    //     $alert['messageAlert'] = 'Cet email est déjà utilisé';
    // } 
    else if (empty($password)) {
        $alert['messageAlert'] = 'Veuillez renseigner votre mot de passe';
    } else if (empty($confirmPassword)) {
        $alert['messageAlert'] = 'Veuillez confirmer votre mot de passe';
    } else if ($password != $confirmPassword) {
        $alert['messageAlert'] = 'Les mots de passe ne correspondent pas';
    }

    // Check if the password has a minimum of 8 characters, 1 uppercase, 1 lowercase and 1 number
    // else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {   À FAIRE MARCHER
    //     $alert['messageAlert'] = 'Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 minuscule et 1 chiffre';
    // }
    return $alert;
}

function register($firstname, $lastname, $email, $password, $confirmPassword, $newsletter)
{
    $check = checkValidity($firstname, $lastname, $email, $password, $confirmPassword);

    if ($newsletter == 'on') {
        $newsletter = 1;
    } else {
        $newsletter = 0;
    }

    // If there is no error, we register the user. Else, we return the error
    if (isset($check['messageAlert'])) {
        return $check;
    } else {
        $database = Connexion::getInstance()->getBdd();
        $query = $database->prepare("INSERT INTO user (firstname, lastname, email, password, newsletter_subscription) VALUES (?, ?, ?, ?, ?)");
        $query->execute(array($firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $newsletter));
        $alert['messageAlert'] = 'Inscription réussie';
        $alert['classAlert'] = 'success';
        return $alert;
    }
}
