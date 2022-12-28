<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>myJourneys.css">
  <link rel="stylesheet" href="<?= PATH_CSS . 'glassmorphism.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'generateJourney.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'journeyPreview.css' ?>">
  <link rel="stylesheet" href="<?= PATH_CSS . 'commentary.css' ?>">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>journeyPreview.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>calculateDistance.js"></script>
</head>
<div id="background-img">
</div>
<main id="accueil">
  <div>
    <h1>Commentaires signalés</h1>
    <article id="commentary-container" class="glass">
        <h2>Commentaires</h2>
        <div class="commentaries-list">
            <?php
            foreach($commentaries as $commentary) {
                ?>
                <div class="commentary glass">
                    <div class="info">
                        <p class="content"><?= $commentary['content'] ?></p>
                        <p class="author">Par <a class="profile-link" href="?page=profil&user=<?= $commentary['user_id'] ?>"><?= $commentary['firstname'] . " " . $commentary['lastname'] ?></a> le <?= $commentary['date'] ?></p>
                    </div>

                    <div class="actions">

                        <form method="post">
                            <input type="hidden" name="commentaryId" value="<?= $commentary['commentary_id'] ?>">
                            <button type="submit" name="deleteCommentary" class="journey-button" title="Supprimer"><i class="fa fa-trash-o"></i></button>
                        </form>

                        <form method="post">
                            <input type="hidden" name="commentaryId" value="<?= $commentary['commentary_id'] ?>">
                            <button type="submit" name="unreportCommentary" class="journey-button" title="Annuler le signalement"><i class="fa fa-times"></i></button>
                        </form>

                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </article>
</main>

<?php //require_once(PATH_VIEWS . 'footer.php'); 
?>