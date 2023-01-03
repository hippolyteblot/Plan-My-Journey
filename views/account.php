<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>form.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css" />
  <script src="<?= PATH_SCRIPTS ?>modal.js" defer></script>
  <script src="<?= PATH_SCRIPTS ?>form.js" defer></script>

</head>
<main id="account">
  <div class="profile-photo">
    <img src="<?= PATH_IMAGES ?>account.png" alt="Photo de profil" whidth="200" height="200" />
  </div>
  <div class="profile-information glass">
    <div class="profile-name">
      <h1>Bonjour <?= $user['firstname'] . ' ' . $user['lastname'] ?></h1>
    </div>
    <div class="profile-disconnect">
      <a href="index.php?page=disconnect"><span>Se déconnecter</span></a>
    </div>
    <div class="profile-parameters glass">
      <div class="profile-parameters-title">
        <h2>Informations</h2>
      </div>
      <div class="profile-parameters-list">
        <li class="profile-firstname">
          <h3>Prénom : <?= $user['firstname'] ?></h3>
        </li>
        <li class="profile-lastname">
          <h3>Nom : <?= $user['lastname'] ?></h3>
        </li>
        <li class="profile-email">
          <h3>E-mail : <?= $user['email'] ?></h3>
        </li>
      </div>
      <div class="profile-parameters-modify">
        <span onclick="openModal('information')">Modifier</span>
      </div>
    </div>
    <div class="profile-preferences glass">
      <div class="profile-preferences-title">
        <h2>Préférences</h2>
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
      <div class="profile-preferences-modify">
        <span onclick="openModal('pref')">Modifier</span>
      </div>

    </div>
    <div class="profile-delete">
      <span onclick="openModal('delete')">Supprimer le compte</span>
    </div>
  </div>
</main>
<div id="modal-delete" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('delete')">&times;</span>
      <h2>Supprimer le compte</h2>
    </div>
    <div class="modal-body">
      <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
      <form method="POST">
        <input class="inputbtn" type="submit" name="delete" value="Supprimer">
        <input class="inputbtn" type="submit" name="keep" value="Non">

      </form>
    </div>
  </div>
</div>
<div id="modal-information" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('information')">&times;</span>
      <h2>Modifier mes informations</h2>
    </div>
    <div class="modal-body">
      <form action="index.php?page=account" method="post" class="form" id="form">
        <div class="form-group">
          <label for="firstname">Prénom</label>
          <div class="form-item">
            <span class="form-item-icon material-symbols-outlined">person</span>
            <input type="text" name="firstname" id="firstname" value="<?= $user['firstname'] ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="lastname">Nom</label>
          <div class="form-item">
            <span class="form-item-icon material-symbols-outlined">person</span>
            <input type="text" name="lastname" id="lastname" value="<?= $user['lastname'] ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <div class="form-item">
            <span class="form-item-icon material-symbols-outlined">email</span>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="password">Nouveau mot de passe</label>
          <div class="form-item">
            <span class="form-item-icon material-symbols-outlined">lock</span>
            <input type="password" name="password" id="password" />
            <span class="form-item-icon-left material-symbols-outlined" id="password-visibility" onclick="visibility('password')">visibility_off</span>
          </div>
        </div>
        <div class="form-group">
          <label for="password_confirm">Confirmer le mot de passe</label>
          <div class="form-item">
            <span class="form-item-icon material-symbols-outlined">lock</span>
            <input type="password" name="password_confirm" id="password_confirm" />
            <span class="form-item-icon-left material-symbols-outlined" id="password-confirm-visibility" onclick="visibility('confirmPassword')">visibility_off</span>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Modifier" />
        </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="modal-pref" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" onclick="closeModal('pref')">&times;</span>
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
        <span id="validate-modif-pref" onclick="closeModal('pref')">Valider</span>
      </div>
      <?php
      foreach ($categories as $category) {
      ?>
        <div class="modal-side category-modal" id="modal-<?= $category["category_id"] ?>">
          <div class="modal-content">
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