<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>accueil.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Découvrez votre planning de rêve</h1>
    <h2>Utilisez notre moteur de recherche et trouvez votre journée de rêve en un clic</h2>
    <form action="index.php?page=query" method="post">
      <div class="formItem item01"><input id="input01" type="text" name="search" placeholder="    Saisissez votre destination"></div>
      <div class="formItem item02">

        <button id="input02" type="Submit">
          <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
          <div class="svg">

          </div>

        </button>


      </div>
  </div>
  <span>
    Swipe up !
  </span>
</main>

<?php require_once(PATH_VIEWS . 'footer.php'); ?>