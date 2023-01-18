<?php

require_once(PATH_MODELS . 'admin.php');
require_once(PATH_MODELS . 'commentary.php');
require_once(PATH_MODELS . 'account.php');

if (isset($_POST['name']) && isset($_POST['password'])) {
    if (isAdmin($_POST['name'], $_POST['password'])) {
        $_SESSION['is_admin'] = 1;
    } else {
        $alert = 'Nom ou mot de passe incorrect';
    }
}

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    $pageName = 'Commentaires signalés';

    if (isset($_POST['unreportCommentary'])) {
        unreportCommentary($_POST['commentaryId']);
    } else if (isset($_POST['deleteCommentary'])) {
        deleteCommentary($_POST['commentaryId']);
    } else if (isset($_POST['banAccount'])) {
        deleteAccount($_POST['userId']);
    }

    $commentaries = getReportedCommentaries();
    require_once(PATH_VIEWS . 'manageReport.php');
} else {
    $pageName = 'Connexion administrateur';
    require_once(PATH_VIEWS . 'admin_login.php');
}
