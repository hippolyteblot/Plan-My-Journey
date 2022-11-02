<?php
// require_once(PATH_MODELS . 'connexion.php');

require_once(PATH_MODELS . 'login.php');

require_once(PATH_MODELS . 'Connexion.php');


$database = Connexion::getInstance()->getBdd();
$query = $database->prepare('SELECT * FROM user');
$query->execute();
$result = $query->fetch();
var_dump($result);


require_once(PATH_VIEWS . $page . '.php');
