<?php
$pageName = "Connexion";

require_once(PATH_MODELS . 'login.php');

require_once(PATH_MODELS . 'Connexion.php');

include_once(PATH_CONTROLLERS . 'cookieconnect.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alert = checkAccount($email, $password);
    if (isset($alert['messageAlert'])) {
        $messageAlert = $alert['messageAlert'];
        $classAlert = $alert['classAlert'];
    } else {
        // Save name, firstname and email in session
        if (isset($_POST['rememberMe'])) {
            setcookie('email', $alert['email'], time() + 365 * 24 * 3600, null, null, false, true);
            setcookie('password', $alert['password'], time() + 365 * 24 * 3600, null, null, false, true);
        }
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $alert['firstname'];
        $_SESSION['lastname'] = $alert['lastname'];
        header('Location: index.php?page=accueil');
    }
}

require_once(PATH_VIEWS . $page . '.php');
