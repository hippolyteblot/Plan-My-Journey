<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>form.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>myJourneys.css">
  <link rel="stylesheet" href="<?= PATH_CSS . 'glassmorphism.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'generateJourney.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'journeyPreview.css' ?>">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>journeyPreview.js"></script>

</head>
<main id="account">
  <div class="profile-photo">
    <img src="<?= PATH_IMAGES ?>account.png" alt="Photo de profil" whidth="200" height="200" />
  </div>
  <div class="profile-sharing glass">
    <div class="profile-name">
      <h1>Statistiques de <?= $user['firstname'] . ' ' . $user['lastname'] ?></h1>
    </div>
    <article class="profile-stats">
        <div>
            <p>Nombre de parcours générés : <?= $nbGeneratedJourneys ?></p>
            <p>Nombre de parcours partagés : <?= $nbSharedJourneys ?></p>
        </div>
        <div>
            <p>Nombre de notation : <?= $nbRatings ?></p>
            <p>Nombre de parcours sauvegardés : <?= $nbSavedJourneys ?></p>
        </div>
        <div>
            <p>Inscrit depuis le : <?= $registrationDate ?></p>
            <p>Nombre de préférences : <?= $nbPreferences ?></p>
        </div>
    </article>
    <div class="profile-name">
      <h1>Parcours partagés par <?= $user['firstname'] . ' ' . $user['lastname'] ?></h1>
    </div>
    <article class="content-container">
          <button class="scroll-btn-left" onclick="scrollLeftBtn('save-journeys')"><i class="fas fa-chevron-left"></i></button>
            <div class="journey-container" id="save-journeys">
              <?php
              foreach ($journeys as $journey) {
                  include(PATH_VIEWS . 'journeyPreview.php');
              }
              ?>
            </div>
          <button class="scroll-btn-right" onclick="scrollRightBtn('save-journeys')"><i class="fas fa-chevron-right"></i></button>
        </article>
    
  </div>
</main>
