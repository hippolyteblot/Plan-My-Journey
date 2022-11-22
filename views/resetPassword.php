<?php
require_once(PATH_VIEWS . 'header.php');
?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>login.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>forgotPass.css" />
  <script defer src="<?= PATH_SCRIPTS ?>form.js"></script>
</head>

<main id="forgot">
  <div class="login-card">
    <div class="login-card-logo">
      <img src="<?= PATH_IMAGES ?>logo.png" alt="">
    </div>
    <div class="login-card-header">
      <h1>Votre nouveau mot de passe</h1>
    </div>
    <form method="POST" action="" class="login-card-form">
      <div class="form-item">
        <span class="form-item-icon material-symbols-outlined">lock</span>
        <input id="password" type="password" placeholder="Entrer votre nouveau mot de passe" required name="password">
        <span class="form-item-icon-left material-symbols-outlined" id="password-visibility" onclick="visibility('password')">visibility_off</span>
      </div>
      <div class="form-item">
        <span class="form-item-icon material-symbols-outlined">lock</span>
        <input id="password_confirm" type="password" placeholder="Confirmer votre mot de passe" required name="confirmPassword">
        <span class="form-item-icon-left material-symbols-outlined" id="password-confirm-visibility" onclick="visibility('confirmPassword')">visibility_off</span>
      </div>
      <?php include_once(PATH_VIEWS . 'alert.php'); ?>
      <button type="submit">Envoyer</button>
    </form>
    <div class="login-card-footer">
      <div>Vous n'avez pas de compte ? <a href="?page=register">Inscrivez-vous</a></div>
    </div>
  </div>
</main>