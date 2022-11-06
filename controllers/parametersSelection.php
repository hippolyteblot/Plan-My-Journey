<?php

$pageName = "Sélection des paramètres";

if(!isset($_SESSION['candidates'])) {
    header('Location: index.php?page=home');
}
$name = $_SESSION['candidates'][0]['name'];
$lat = $_SESSION['candidates'][0]['geometry']['location']['lat'];
$lng = $_SESSION['candidates'][0]['geometry']['location']['lng'];
$fullAddress = $_SESSION['candidates'][0]['formatted_address'];


require_once(PATH_VIEWS . 'parametersSelection.php');