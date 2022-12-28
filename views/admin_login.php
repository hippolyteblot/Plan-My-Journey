<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>login.css" />
  <script defer src="<?= PATH_SCRIPTS ?>form.js"></script>
</head>

<main id="connexion">
  <div class="login-card-container">
    <div class="login-card">
      <div class="login-card-logo">
        <img src="<?= PATH_IMAGES ?>logo.png" alt="">
      </div>
      <div class="login-card-header">
        <h1>Connexion</h1>
        <div>Connectez vous en tant qu'administrateur</div>
      </div>
      <form method="POST" action="?page=manageReport" class="login-card-form">
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">mail</span>
          <input type="text" placeholder="Entrer votre identifiant" required autofocus name="name" id="">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input type="password" placeholder="Entrer votre mot de passe" required name="password" id="password">
          <span class="form-item-icon-left material-symbols-outlined" id="password-visibility" onclick="visibility('password')">visibility_off</span>
        </div>
        
        <?php include_once(PATH_VIEWS . 'alert.php'); ?>
        <button type="submit">Se connecter</button>
      </form>

      <!-- Hash the password admin and echo it here -->
        <?php
        if(password_verify('admin', ADMIN_PWD)) {
          echo password_hash('admin', PASSWORD_DEFAULT);
        } else {
          echo 'Error';
        }

        ?>
    </div>
  </div>
</main>

<?php
