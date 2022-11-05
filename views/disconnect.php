<?php
session_start();

setcookie('email', '', time() - 3600, null, null, false, true);
setcookie('password', '', time() - 3600, null, null, false, true);

$_SESSION = array();

session_destroy();

header('Location: index.php?page=home');
