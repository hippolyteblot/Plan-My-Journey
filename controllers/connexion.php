<?php
// require_once(PATH_MODELS . 'connexion.php');

require_once(PATH_MODELS . 'login.php');

require_once(PATH_MODELS . 'Connexion.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alert = checkAccount($email, $password);
    if (isset($alert['messageAlert'])) {
        $messageAlert = $alert['messageAlert'];
        $classAlert = $alert['classAlert'];
    } else {
        // Save name, firstname and email in session
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $alert['firstname'];
        $_SESSION['lastname'] = $alert['lastname'];
        header('Location: index.php?page=accueil');
    }

}

require_once(PATH_VIEWS . $page . '.php');
