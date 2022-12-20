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
      <!--<button class="filter-button glass" onclick="openModal('trier')">Trier</button>-->
      <button class="filter-button glass" onclick="deleteJourneysFromDOM(); sortJourneysByDate(); addJourneysToDOM();">Date</button> <!-- Changer pour laisser le choix pour le tri -->
      
    </div>
    <h2>Voici un ensemble de parcours partagés par la communauté</h2>
    <div class="journey-container">
        <?php foreach ($journeysArray as $journey) {
            include(PATH_VIEWS . 'journeyPreview.php');
        } ?>
    </div>

</div>


<div id="modal-trier" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('filter')">&times;</span>
        <h2>Filtrer</h2>
    </div>
    <!-- Allow to filter from rating, location, corresponding preferences and date -->
    <div class="modal-body">
      <form action="index.php?page=discover" method="post">
        <div class="form-group">
          <label for="rating">Note minimum</label>
          <select name="rating" id="rating">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="location">Localisation</label>
          <input type="text" name="location" id="location" placeholder="Localisation">
        </div>
        <div class="form-group">
          <label for="date">Horaires</label>
                <div class="time inputGroup">
                    <div class="timeItem">
                        <label for="timeFrom">De </label>
                        <input type="time" name="timeFrom" id="timeFrom" value="10:00">
                    </div>
                    
                    <div class="timeItem">
                        <label for="timeTo">A </label>
                        <input type="time" name="timeTo" id="timeTo" value="18:00">
                    </div>
                </div>
        </div>

        <div class="form-group">
          <label for="preferences">Préférences</label>
          <select name="preferences" id="preferences">
            <option value="0">Toutes</option>
            <option value="1">Principales</option>
            <option value="2">Secondaires</option>
          </select>
        </div>
        <div class="form-group">
          <input type="submit" value="Filtrer">
        </div>
      </form>
    </div>
    </div>
</div>
