<?php require_once(PATH_VIEWS . 'header.php'); ?>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Découvrer votre planning de rêve</h1>
    <h2>Utilisez notre moteur de recherche et trouvez votre journée de rêve en un clic</h2>
    <form action="index.php?page=query" method="post">
      <div class="formItem item01"><input id="input01" type="text" name="search" placeholder="Rechercher un événement"></div>
      <div class="formItem item02">
        <input id="input02" type="image" src="<?= PATH_IMAGES ?>search.png" alt="Submit" style="float:right" width="40" height="40">

      </div>
  </div>
  <span>
    Swip up !
  </span>
</main>

<?php require_once(PATH_VIEWS . 'footer.php'); ?>