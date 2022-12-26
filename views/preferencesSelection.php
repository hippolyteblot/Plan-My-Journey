<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>

</head>
<div id="background-img">
</div>
<main id="accueil">
  <h1>Voulez-vous affiner vos préférences pour ce parcours ?</h1>
  <div class="glass">
    <div class="profile-preferences glass">
      <div class="profile-preferences-title">
        <h2>Mes préférences</h2>
      </div>
      <div class="profile-preferences-list">
        <ul>
          <li>
            <h3>Restaurant</h3>
            <span class="pref-list">
              <?php
              foreach ($primaryPreferences as $preference) {
                if ($preference['structure_type'] == 'R') {
                  echo "<p>" . $preference['primary_type_name'] . "</p>";
                }
              }
              foreach ($secondaryPreferences as $preference) {
                if ($preference['structure_type'] == 'R') {
                  echo "<p>" . $preference['secondary_type_name'] . "</p>";
                }
              }
              ?>

            </span>
          </li>
          <li>
            <h3>Activités</h3>
            <span class="pref-list">
              <?php
              foreach ($primaryPreferences as $preference) {
                if ($preference['structure_type'] == 'A') {
                  echo "<p>" . $preference['primary_type_name'] . "</p>";
                }
              }
              foreach ($secondaryPreferences as $preference) {
                if ($preference['structure_type'] == 'A') {
                  echo "<p>" . $preference['secondary_type_name'] . "</p>";
                }
              }
              ?>

            </span>
          </li>
        </ul>
      </div>
    </div>

    <form action="" method="post">
      <button type="submit" value="Y" name="Y/N">Oui</button>
      <button type="submit" value="N" name="Y/N">Non</button>
    </form>
  </div>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>