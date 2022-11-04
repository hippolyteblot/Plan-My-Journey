<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css" />
  <script src="<?= PATH_SCRIPTS ?>modal.js" defer></script>

</head>
<main id="account">
  <div class="profile-photo">
    <span>Voici ma photo de profil</span>
  </div>
  <div class="profile-information">
    <div class="profile-name">
      <h1>Bonjour <?= $user['firstname'] . ' ' . $user['lastname'] ?></h1>
    </div>
    <div class="profile-disconnect">
      <a href="index.php?page=disconnect"><span>Se déconnecter</span></a>
    </div>
    <div class="profile-parameters">
      <div class="profile-parameters-title">
        <h2>Paramètres</h2>
      </div>
      <div class="profile-parameters-list">
        <li class="profile-firstname">
          <p><?= $user['firstname'] ?></p>
        </li>
        <li class="profile-lastname">
          <p><?= $user['lastname'] ?></p>
        </li>
        <li class="profile-email">
          <p><?= $user['email'] ?></p>
        </li>
      </div>
      <div class="profile-parameters-modify">
        <a href="index.php?page=modifier"><span>Modifier</span></a>
      </div>
    </div>
    <div class="profile-preferences">
      <div class="profile-preferences-title">
        <h2>Préférences</h2>
      </div>
      <div class="profile-preferences-list">
        <ul>
          <li>
            <p>Restaurant</p>
          </li>
          <li>
            <p>Activités</p>
            <span id="test">
              <?php foreach ($preferences as $preference) : ?>
                <p><?= $preference; ?></p>
              <?php endforeach; ?>
            </span>
          </li>
        </ul>
      </div>
      <div class="profile-preferences-modify">
        <span onclick="openModal('pref')">Modifier</span>
      </div>



    </div>
  </div>
</main>

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
              <span>Restaurants asiatiques</span>
              <span>Restaurants européens</span>
            </div>
          </div>
        </div>
        <div class="category">
          <h3>Activités</h3>

          <div class="category-list">
            <div class="profile-preferences-modify profile-preferences-type">
              <?php
              foreach ($categories as $category) {
                echo '<span onclick="openModal(' . $category['category_id'] . ')">' . $category['category_name'] . '</span>';
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
                      if (in_array($primaryType['primary_type_name'], $preferences)) {
                        echo '<p class="item selected">' . $primaryType['primary_type_name'] . '</p>';
                      } else {
                        echo '<p class="item">' . $primaryType['primary_type_name'] . '</p>';
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