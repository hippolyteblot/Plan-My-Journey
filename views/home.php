<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>accueil.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Découvrez votre planning de rêve</h1>
    <h2>Utilisez notre moteur de recherche et trouvez votre journée de rêve en un clic</h2>
    <form action="index.php?page=locationQuery" method="post">
      <div class="formItem item01"><input id="input01" type="text" name="locationName" placeholder="Saisissez votre destination"></div>
      <div class="formItem item02">

        <button id="input02" type="Submit">
          <span class="material-symbols-outlined">
            search
          </span>

        </button>
      </div>
    </form>
    <br />
    <?php include_once(PATH_VIEWS . 'alert.php'); ?>
  </div>
  <span>
    Swipe up !
  </span>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>