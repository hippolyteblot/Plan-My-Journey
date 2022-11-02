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
          <li>Restaurant</li>
          <li>Loisir</li>
          <li>Je ne sais pas</li>
        </ul>
      </div>
      <div class="profile-preferences-modify">
        <span id="myBtn">Modifier</span>
      </div>

      

    </div>
  </div>
</main>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Modification des préférences</h2>
    </div>
    <div class="modal-body">
      <div class="categories">
        <div class="category">
          <h3>Restauration</h3>
          <div class="category-list">
            <p class="item">Restaurant</p>
            <p class="item">Fast-food</p>
            <p class="item">Snack</p>
          </div>
        </div>
        <div class="category">
          <h3>Activités</h3>
          <div class="category-list">
            <?php
            foreach ($primaryTypes as $primaryType) {
              echo '<p class="item">' . $primaryType['primary_type_name'] . '</p>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <!-- validation button -->
      <span id="validate-modif-pref">Valider</span>
    </div>
  </div>

</div>