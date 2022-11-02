<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>connexion.css" />
</head>

<main id="connexion">
  <div class="login-card-container inscription">
    <div class="login-card">
      <div class="login-card-logo">
        <img src="<?= PATH_IMAGES ?>logo.png" alt="">
      </div>
      <div class="login-card-header">
        <h1>Inscription</h1>
        <div>Inscrivez-vous pour utiliser nos services.</div>
      </div>
      <form action="" class="login-card-form" method="POST">
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">person</span>
          <input type="text" placeholder="Entrer votre prénom" required autofocus name="firstname">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">person</span>
          <input type="text" placeholder="Entrer votre nom" required autofocus name="lastname">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">mail</span>
          <input type="text" placeholder="Entrer votre mail" required autofocus name="email">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input type="password" placeholder="Entrer votre mot de passe" required name="password">
        </div>
        <div class="form-item">
          <span class="form-item-icon material-symbols-outlined">lock</span>
          <input type="password" placeholder="Confirmer votre mot de passe" required name="confirmPassword">
        </div>
        <div class="form-item-other-inscription">
          <div class="checkbox">
            <input type="checkbox" name="newsletter" id="newsLetter">
            <label for="rememberMe">S'abonner à la newsletter.</label>
          </div>
          <div class="checkbox">
            <input type="checkbox" name="" id="cgu" required>
            <label for="rememberMe">Accepter le contrat d'utilisation.<a href="#">CGU</a></label>
          </div>
        </div>
        <?php include(PATH_VIEWS . 'alert.php'); ?>
        <button type="submit">S'inscrire</button>
      </form>
      <div class="login-card-footer">
        <div>Vous avez déjà un compte ? <a href="?page=connexion">Connectez-vous</a></div>
      </div>
    </div>
    <div class="login-card-social">
      <div>S'inscrire avec</div>
      <div class="login-card-social-btns">
        <a href="#" class="btn-facebook">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
          </svg>
        </a>
        <a href="#" class="btn-google">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</main>