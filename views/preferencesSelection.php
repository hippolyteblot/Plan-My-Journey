<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css" />
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script src="<?= PATH_SCRIPTS ?>modal.js" defer></script>
  <script src="<?= PATH_SCRIPTS ?>selection.js" defer></script>

</head>
<div id="background-img">
</div>
<main id="accueil">
  <h1>Voulez-vous affiner vos préférences pour ce parcours uniquement ?</h1>
  <div class="glass">
    <div class="profile-preferences">
      <div class="profile-preferences-title">
        <h2>Mes préférences</h2>
      </div>
      <div class="profile-preferences-list">
        <ul>
          <li>
            <h3>Restaurant</h3>
            <span class="pref-list">
              <?php
              foreach ($primaryTypes as $primaryType) {
                if ($primaryType['structure_type'] == 'R') {
                  $primaryType['primary_type_name'] = str_replace(' ', '-', $primaryType['primary_type_name']);
                  echo '<p class="rest ' . $primaryType['primary_type_name'] . '" >' . $primaryType['primary_type_name'] . '</p>';
                }
              }
              foreach ($secondaryTypes as $secondaryType) {
                if ($secondaryType['structure_type'] == 'R') {
                  $secondaryType['secondary_type_name'] = str_replace(' ', '-', $secondaryType['secondary_type_name']);
                  echo '<p class="rest ' . $secondaryType['secondary_type_name'] . '" >' . $secondaryType['secondary_type_name'] . '</p>';
                }
              }
              ?>

            </span>
          </li>
          <li>
            <h3>Activités</h3>
            <span class="pref-list">
              <?php
              foreach ($primaryTypes as $primaryType) {
                if ($primaryType['structure_type'] == 'A') {
                  $test = str_replace(' ', '-', $primaryType['primary_type_name']);
                  echo '<p class="act ' . $test . '" >' . $primaryType['primary_type_name'] . '</p>';
                }
              }
              foreach ($secondaryTypes as $secondaryType) {
                if ($secondaryType['structure_type'] == 'A') {
                  $test = str_replace(' ', '-', $secondaryType['secondary_type_name']);
                  echo '<p class="act ' . $test . '" >' . $secondaryType['secondary_type_name'] . '</p>';
                }
              }
              ?>

            </span>
          </li>
        </ul>
      </div>
    </div>
    <div class="choice">
      <button onclick="openModal('pref')">Modifier</button>
      <form action="" method="post">
        <button type="submit" value="Y" name="Y/N">Envoyer</button>
      </form>
    </div>
  </div>
  <div id="modal-pref" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" onclick="closeModal('pref');sendAllPreferences()">&times;</span>
        <h2>Modification des préférences</h2>
      </div>
      <div class="modal-body">
        <div class="categories">
          <div class="category">
            <h3>Restauration</h3>
            <div class="category-list">
              <div class="profile-preferences-modify profile-preferences-type">
                <?php
                foreach ($categories as $category) {
                  if ($category['structure_type'] == 'R') {
                    echo '<span onclick="openModal(' . $category['category_id'] . ')">' . $category['category_name'] . '</span>';
                  }
                }
                ?>
              </div>
            </div>
          </div>
          <div class="category">
            <h3>Activités</h3>

            <div class="category-list">
              <div class="profile-preferences-modify profile-preferences-type">
                <?php
                foreach ($categories as $category) {
                  if ($category['structure_type'] == 'A') {
                    echo '<span onclick="openModal(' . $category['category_id'] . ')">' . $category['category_name'] . '</span>';
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <!-- validation button -->
          <span id="validate-modif-pref" onclick="closeModal('pref');sendAllPreferences()">Valider</span>
        </div>
        <?php
        foreach ($categories as $category) {
        ?>
          <div class="modal-side category-modal" id="modal-<?= $category["category_id"] ?>">
            <div class="modal-content pref-selec">
              <div class="modal-header">
                <span class="close" onclick="closeModal(<?= $category['category_id'] ?>)">&times;</span>
                <h2>Liste des préférences liées au terme : <?= $category["category_name"] ?></h2>
              </div>
              <div class="modal-body">
                <h3>Sélectionnez vos préférences</h3>
                <div class="category">
                  <div class="category-list">
                    <?php
                    foreach ($primaryTypes as $primaryType) {
                      if ($primaryType['category_id'] == $category['category_id']) {
                        if (in_array($primaryType['primary_type_id'], $primaryPreferencesId)) {
                          echo '<p class="item selected primary" value="' . $primaryType['primary_type_id'] . '">' . $primaryType['primary_type_name'] . '</p>';
                        } else {
                          echo '<p class="item primary" value="' . $primaryType['primary_type_id'] . '">' . $primaryType['primary_type_name'] . '</p>';
                        }
                      }
                    }

                    foreach ($secondaryTypes as $secondaryType) {
                      if ($secondaryType['category_id'] == $category['category_id']) {
                        if (in_array($secondaryType['secondary_type_id'], $secondaryPreferencesId)) {
                          echo '<p class="item selected secondary" value="' . $secondaryType['secondary_type_id'] . '">' . $secondaryType['secondary_type_name'] . '</p>';
                        } else {
                          echo '<p class="item secondary" value="' . $secondaryType['secondary_type_id'] . '">' . $secondaryType['secondary_type_name'] . '</p>';
                        }
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>

    </div>
  </div>

</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>