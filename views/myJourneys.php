<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>myJourneys.css">
  <link rel="stylesheet" href="<?= PATH_CSS . 'glassmorphism.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'generateJourney.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'journeyPreview.css' ?>">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>journeyPreview.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>calculateDistance.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Mes journées</h1>
    <?php if (count($favoriteJourneys)==0){
              echo "<br> Vous n'avez pas encore de parcours favoris <br>";
          }
          else {
            ?> 
    <details>
        <summary>Parcours favoris</summary>
        <article class="journey-container">
            <?php
            foreach ($favoriteJourneys as $journey) {
                include(PATH_VIEWS . 'journeyPreview.php');
            }
            ?>
        </article>
    </details>
    <?php
          } ?>

    <?php if (count($generatedJourneys)==0){
              echo "<br> Vous n'avez pas encore généré de parcours <br>";
          }
          else {
            ?> 
    <details>
        <summary>Parcours générés</summary>

      <article class="journey-container">
          <?php
          foreach ($generatedJourneys as $journey) {
              include(PATH_VIEWS . 'journeyPreview.php');
          }
          ?>
           <?php
          } ?>
      
      </article>
    </details>
          <?php if (count($savedJourneys)==0){
              echo "<br> Vous n'avez pas encore sauvegarder de parcours <br>";
          }
          else {
            ?> 
            <details>
        <summary>Parcours enregistrés</summary>

      <article class="journey-container">
          <?php
          foreach ($savedJourneys as $journey) {
              include(PATH_VIEWS . 'journeyPreview.php');
          }
          ?>
      
      </article> 
    </details>
            <?php
          } ?>
    
    
    <br />
    <?php include_once(PATH_VIEWS . 'alert.php'); ?>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>