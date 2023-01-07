<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>login.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css" />
  <script defer src="<?= PATH_SCRIPTS ?>register.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>form.js"></script>
</head>

<main id="connexion">
  <div class="login-card-container inscription">
    <div class="login-card glass">
      <div class="login-card-logo">
        <img src="<?= PATH_IMAGES ?>logo.png" alt="">
      </div>
      <div class="login-card-header">
        <h1>Inscription</h1>
        <div>Inscrivez-vous pour utiliser nos services.</div>
      </div>
      <form action="" class="login-card-form" method="POST">
        <div class="form-item item01">
          <span class="form-item-icon material-symbols-outlined">person</span>
          <input type="text" placeholder="Entrer votre prénom" required autofocus name="firstname">
        </div>
        <div class="form-item item02">
          <span class="form-item-icon material-symbols-outlined">person</span>
          <input type="text" placeholder="Entrer votre nom" required autofocus name="lastname">
        </div>
        <div class="form-item item03">
          <span class="form-item-icon material-symbols-outlined">mail</span>
          <input id="email" type="text" placeholder="Entrer votre mail" required autofocus name="email">
        </div>
        <div class="form-item item04">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input id="password" type="password" placeholder="Entrer votre mot de passe" required name="password">
          <span class="form-item-icon-left material-symbols-outlined" id="password-visibility" onclick="visibility('password')">visibility_off</span>
        </div>
        <div class="form-item item05">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input id="password_confirm" type="password" placeholder="Confirmer votre mot de passe" required name="confirmPassword">
          <span class="form-item-icon-left material-symbols-outlined" id="password-confirm-visibility" onclick="visibility('confirmPassword')">visibility_off</span>
        </div>
        <div class="form-item-other-inscription">
          <div class="checkbox">
            <input type="checkbox" name="newsletter" id="newsLetter">
            <label for="rememberMe">S'abonner à la newsletter.</label>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="" id="cgu" required>
            <label for="rememberMe">Accepter le contrat d'utilisation.<a target="_blank" href="?page=CGU">CGU</a></label>
          </div>
        </div>
        <?php include(PATH_VIEWS . 'alert.php'); ?>
        <button type="submit">S'inscrire</button>
      </form>
      <div class="login-card-footer">
        <p>Vous avez déjà un compte ? <a href="?page=login">Connectez-vous</a></p>
      </div>
    </div>
    
  </div>
</main>