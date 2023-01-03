<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>accueil.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Bienvenue sur Plan My Journey !</h1>
    <h2>Utilisez notre moteur de recherche et générez votre parcours de rêve en un clic</h2>
    <br />
    <article id="explain">
        <div id="explain-container">
            <div><span class="number" id="nb1">1</span><div class="glass">Créez votre compte et renseignez vos préférences</div></div>
            <div><span class="number" id="nb2">2</span><div class="glass">Rentrez votre destination et saisissez les paramètres de votre parcours</div></div>
            <div><span class="number" id="nb3">3</span><div class="glass">Générez votre parcours et profitez de votre journée !</div></div>
            <div><span class="number" id="nb4">4</span><div class="glass">Partagez votre parcours à la communauté et découvrez les parcours les plus populaires</div></div>
        </div>
    </article>
    <br />
    <div id="btn-connect">
        <button class="glass" onclick="window.location.href='index.php?page=register'">Créer un compte</button>
        <span>ou</span>
        <button class="glass" onclick="window.location.href='index.php?page=login'">Se connecter</button>
    </div>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>