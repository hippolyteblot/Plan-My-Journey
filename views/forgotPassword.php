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
      <h1>Mot de passe oublié</h1>
      <div>Entrez votre adresse mail pour réinitialiser votre mot de passe.</div>
    </div>
    <form method="POST" action="?page=forgotPassword" class="login-card-form">
      <div class="form-item">
        <span class="form-item-icon material-symbols-outlined">mail</span>
        <input type="text" placeholder="Entrer votre mail" required autofocus name="email" id="">
      </div>
      <?php include_once(PATH_VIEWS . 'alert.php'); ?>
      <button type="submit">Envoyer</button>
    </form>
    <div class="login-card-footer">
      <div>Vous n'avez pas de compte ? <a href="?page=register">Inscrivez-vous</a></div>
    </div>
  </div>
</main>