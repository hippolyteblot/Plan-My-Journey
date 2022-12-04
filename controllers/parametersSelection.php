<?php

$pageName = "Sélection des paramètres";

if(!isset($_SESSION['candidates'])) {
    header('Location: index.php?page=home');
}


require_once(PATH_VIEWS . 'parametersSelection.php');