<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>login.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css" />
  <script defer src="<?= PATH_SCRIPTS ?>form.js"></script>
</head>

<main id="connexion">
  <div class="login-card-container">
    <div class="login-card glass">
      <div class="login-card-logo">
        <img src="<?= PATH_IMAGES ?>logo.png" alt="">
      </div>
      <div class="login-card-header">
        <h1>Connexion</h1>
        <p>Connectez vous pour utiliser nos services.</p>
      </div>
      <form method="POST" action="?page=login" class="login-card-form">
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">mail</span>
          <input type="text" placeholder="Entrer votre mail" required autofocus name="email" id="">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input type="password" placeholder="Entrer votre mot de passe" required name="password" id="password">
          <span class="form-item-icon-left material-symbols-outlined" id="password-visibility" onclick="visibility('password')">visibility_off</span>
        </div>
        <div class="form-item-other">
          <div class="checkbox">
            <input type="checkbox" name="rememberMe" id="rememberMe">
            <label for="rememberMe">Se souvenir de moi</label>
          </div>
          <a href="?page=forgotPassword">Mot de passe oublié</a>
        </div>
        <?php include_once(PATH_VIEWS . 'alert.php'); ?>
        <button type="submit">Se connecter</button>
      </form>
      <div class="login-card-footer">
        <div>Vous n'avez pas de compte ? <a href="?page=register">Inscrivez-vous</a></div>
      </div>
    </div>
    
  </div>
</main>

<?php
