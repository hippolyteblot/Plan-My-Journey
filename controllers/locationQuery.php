<?php


require_once(PATH_MODELS . 'locationQuery.php');

$locationName = $_POST['locationName'];
$locationName = str_replace(' ', '+', $locationName);

$candidates = getCandidates($locationName);

// If there is no candidates
if (empty($candidates)) {
    $alert['classAlert'] = 'danger';
    $alert['messageAlert'] = 'Aucune ville trouvée';
    $pageName = "Accueil";
    require_once(PATH_VIEWS . 'home.php');
} else {
    $_SESSION['candidates'] = $candidates;
    $pageName = "Sélection des paramètres";
    header('Location: index.php?page=parametersSelection');
}
