<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
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
        <h2>Preferences</h2>
      </div>
      <div class="profile-preferences-list">
        <ul>
          <li>Restaurant</li>
          <li>Loisir</li>
          <li>Je ne sais pas</li>
        </ul>
      </div>
      <div class="profile-preferences-modify">
        <a href="index.php?page=modifier"><span>Modifier</span></a>
      </div>
    </div>
  </div>
</main>