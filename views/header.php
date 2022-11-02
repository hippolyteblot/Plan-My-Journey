<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DOCUMENT</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <link rel="stylesheet" href="<?= PATH_CSS ?>alert.css" />
  <link rel="stylesheet" href="<?= PATH_CSS ?>reset.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>header.css" />
  <script src="https://kit.fontawesome.com/f06f56c2b1.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav>
    <ul class="header-nav">
      <div class="left">
        <li><a href="index.php"><img src="<?= PATH_IMAGES ?>logo.png" alt="logo"></a></li>
        <li><span>Plan My Journey</span></li>
      </div>
      <input type="checkbox" id="check" />
      <label for="check">
        <i class="fas fa-chevron-circle-down"></i>
      </label>
      <div class="right">
        <?php if (isset($_SESSION['email'])) { ?>
          <li><a href="index.php?page=parcours">
              <span class="material-symbols-outlined">signpost</span>
              <span>Mes parcours</span>
            </a></li>
        <?php } ?>
        <li>
          <a href="#">
            <span class="material-symbols-outlined">share</span>
            <span>Découvrir</span>
          </a>
        </li>
        <?php if (isset($_SESSION['email'])) { ?>
          <li><a href="index.php?page=account"><span class="btn">Mon compte</span></a></li>
        <?php } else { ?>
          <li><a href="index.php?page=connexion"><span class="btn">Connectez-vous</span></a></li>
        <?php } ?>
      </div>
    </ul>
  </nav>
  <section class="container" style="margin-top: 50px;">