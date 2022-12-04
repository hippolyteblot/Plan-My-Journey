<?php

const DEBUG = true; // production : false; dev : true

// Accès base de données
const BD_HOST = '35.181.153.68';
//const BD_HOST = 'localhost';
const BD_DBNAME = 'plan_my_journey';
const BD_USER = 'root';
const BD_PWD = 'Planmyjourney';
//const BD_PWD = 'root';

// Langue du site
const LANG = 'FR-fr';

// Paramètres du site : nom de l'auteur ou des auteurs
const AUTEUR = 'Matéo Guenot & Noah Heraud & Hippolyte Blot';

// Clé privé de l'API Google
//const KEY = "AIzaSyDsSWpa4y-dsYA7BBA-I4xJq60be0qAHUI"; // <- Hippo
const KEY = "AIzaSyBAbAVbxk-8sF-HlDk92YeQ9wop5tH6yyc"; // <- Noah

//dossiers racines du site
define('PATH_CONTROLLERS', './controllers/');
define('PATH_ENTITY', './entities/');
define('PATH_ASSETS', './assets/');
define('PATH_LIB', './lib/');
define('PATH_MODELS', './models/');
define('PATH_VIEWS', './views/');
define('PATH_TEXTES', './languages/');

//sous dossiers
define('PATH_CSS', PATH_ASSETS . 'css/');
define('PATH_IMAGES', PATH_ASSETS . 'images/');
define('PATH_SCRIPTS', PATH_ASSETS . 'scripts/');

//fichiers
define('PATH_LOGO', PATH_IMAGES . 'logo.png');
define('PATH_MENU', PATH_VIEWS . 'menu.php');

