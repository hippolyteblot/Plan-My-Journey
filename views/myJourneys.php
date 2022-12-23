<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>myJourneys.css">
  <link rel="stylesheet" href="<?= PATH_CSS . 'glassmorphism.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'generateJourney.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'journeyPreview.css' ?>">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>journeyPreview.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Mes journées</h1>
    <h2>Parcours générés</h2>
    <article class="journey-container">
        <?php
        foreach ($generatedJourneys as $journey) {
            include(PATH_VIEWS . 'journeyPreview.php');
        }
        ?>
    
    </article>

    <h2>Parcours enregistrés</h2>
    <article class="journey-container">
        <?php
        foreach ($savedJourneys as $journey) {
            include(PATH_VIEWS . 'journeyPreview.php');
        }
        ?>
    
    </article>
    
    <br />
    <?php include_once(PATH_VIEWS . 'alert.php'); ?>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>