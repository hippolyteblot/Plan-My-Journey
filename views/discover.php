<?php require_once(PATH_VIEWS . 'header.php');

?> 

<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>discover.css"> 
    <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css" />
    <link rel="stylesheet" href="<?= PATH_CSS ?>journeyPreview.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css" />
    <script src="<?= PATH_SCRIPTS ?>modal.js" defer></script>
    <script defer src="<?= PATH_SCRIPTS ?>journey.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>sortJourneys.js"></script>
</head>
<div id="corps">
    
        <h1>Découvrir</h1>
        <!-- Here is the filter options -->
        
    <div id="banner">
      <div class="search-bar">
          <form action="?page=discover" method="post">
              <input type="text" name="location" placeholder="Rechercher une destination">
              <button type="submit" class="search-button glass">
                <span class="material-symbols-outlined">
                  search
                </span>
              </button>
          </form>
        </div>
      <button class="filter-button glass" onclick="openModal('trier')">Trier</button>
      <!--<button class="filter-button glass" onclick="deleteJourneysFromDOM(); sortJourneysByDate(); addJourneysToDOM();">Date</button> Changer pour laisser le choix pour le tri -->
      
    </div>
    <h2>Voici un ensemble de parcours partagés par la communauté</h2>
    <div class="journey-container-grid">
        <?php foreach ($journeysArray as $journey) {
            include(PATH_VIEWS . 'journeyPreview.php');
        } ?>
    </div>

</div>


<div id="modal-trier" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('trier')">&times;</span>
        <h2>Trier les parcours par :</h2>
    </div>
    <!-- Allow to filter from rating, location, corresponding preferences and date -->
    <div class="modal-body">
      <button class="sort-button glass" onclick="manageDateSort(this);">Date ↓</button>
      <button class="sort-button glass" onclick="manageRatingSort(this);">Note ↓</button>
    </div>
  </div>
</div>
