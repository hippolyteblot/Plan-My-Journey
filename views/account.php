<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>account.css" />
</head>

<main id="account">
  <div class="profile-photo">

  </div>
  <div class="profile-information">
    <div class="profile-name">
      <h1><?= $user['first_name'] . ' ' . $user['last_name'] ?></h1>
    </div>
    <div class="profile-parameters">
      <h2>Paramètres</h2>
      <div class="profile-email">
        <p><?= $user['email'] ?></p>
      </div>
      <div class="profile-phone">
        <p><?= $user['phone'] ?></p>
      </div>
      <div class="profile-firstname">
        <p><?= $user['first_name'] ?></p>
      </div>
    </div>
    <div class="profile-preferences">
      <div class="profile-preferences-title">
        <h2>Preferences</h2>
      </div>
      <div class="profile-preferences-list">
        <ul>
          <li>Preference 1</li>
          <li>Preference 2</li>
          <li>Preference 3</li>
          <li>Preference 4</li>
          <li>Preference 5</li>
        </ul>
      </div>

    </div>

  </div>
</main>