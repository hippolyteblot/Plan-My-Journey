<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>accueil.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <br />
    <br />
    <h1>Découvrez votre planning de rêve</h1>
    <h2>Utilisez notre moteur de recherche et trouvez votre journée de rêve en un clic</h2>
    <?php
    if(isset($tooMuchQuery) && $tooMuchQuery) {
        echo '<br><p class="alert alert-danger">Vous avez atteint le nombre maximum de requêtes pour aujourd\'hui. Veuillez réessayer demain.</p>';
    } else {
      ?>
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
      <?php
    }
    ?>
    <br />
    <?php include_once(PATH_VIEWS . 'alert.php'); ?>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>