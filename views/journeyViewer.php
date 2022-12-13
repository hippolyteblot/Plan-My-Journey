<?php require_once(PATH_VIEWS . 'header.php'); ?>
<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>generateJourney.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>notation.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>generateJourney.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>modal.js"></script>
</head>
<div id="background-img"></div>
<main id="accueil">
    <div class="glass">
        <h1><?= $journey->getTitle() ?></h1>
        <div id="description">
            <p><?= $journey->getDescription() ?></p>
        </div>
        <?php
            $journeySchema = $journey->getSchema();
            ?>
        <div style="display: flex">
            <div class="vertical-line"></div>
            <div style="display: flex; flex-direction: column; width: 100%">
            <?php
            foreach($journeySchema as $moment) {
            ?>
                <div class="step-container">
                    <div class="change-step arrow-left"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></div>
                    <article class="step">
                    <h2><?= $moment["type_name"] ?> - <?= substr($moment["candidates"][0]["start"], 0, 5) ?> à <?= substr($moment["candidates"][0]["end"], 0, 5) ?></h2>
                    <div class="candidates">
                    <?php
                    foreach($moment["candidates"] as $candidate) {
                        if($candidate["isSelected"] == 1) { ?>
                            <div class="step-infos active">
                                <p><?= $candidate["step_name"] ?></p>
                                <p><?= $candidate["step_vicinity"] ?></p>
                                <input type="hidden" name="candidate-id" value="<?= $candidate["candidates"][0]["place_id"] ?>">                             
                                <span class="rating">
                                <?php
                                if(isset($candidate["step_rating"])) {
                                    echo "<p name='step_rate_0' value='".$candidate["step_rating"]."'>" . $candidate["step_rating"] . " ";
                                    
                                    for($j = 0; $j < 5; $j++) {
                                        if($j < $candidate["step_rating"]) {
                                            ?>
                                            <span class="fa fa-star checked"></span>
                                            <?php
                                        } else { ?>
                                            <span class="fa fa-star"></span>
                                        <?php
                                        }
                                    }
                                } else {
                                    echo "Pas de notation";
                                }
                                ?>
                            </span>
                        </div>
                                
                        <?php
                        } else { ?>
                            <div class="step-infos">
                                <p><?= $candidate["step_name"] ?></p>
                                <p><?= $candidate["step_vicinity"] ?></p>
                                <input type="hidden" name="candidate-id" value="<?= $candidate["candidates"][0]["place_id"] ?>">                             
                                <span class="rating">
                                <?php
                                if(isset($candidate["step_rating"])) {
                                    echo "<p name='step_rate_0' value='".$candidate["step_rating"]."'>" . $candidate["step_rating"] . " ";
                                    
                                    for($j = 0; $j < 5; $j++) {
                                        if($j < $candidate["step_rating"]) {
                                            ?>
                                            <span class="fa fa-star checked"></span>
                                            <?php
                                        } else { ?>
                                            <span class="fa fa-star"></span>
                                        <?php
                                        }
                                    }
                                } else {
                                    echo "Pas de notation";
                                }
                                ?>
                                </span>
                            </div>
                        <?php
                        }

                    ?>
                <?php
                    
                    }
                    ?>
                    </article>
                    <button class="change-step arrow-right"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></button>
                </div>
            <?php
                }
                ?>
            </div>
        </div>
        </form>
        <div class="button-container">
            <?php
            if(!$journey->isPublic() && $journey->getCreator() == $_SESSION["id"]) {
                echo '<button id="btn-modal-share" class="journey-button">Partager</button>';
            }
            if($journey->isPublic() && $journey->getCreator() == $_SESSION["id"]) {
                echo '<button id="btn-modal-share" class="journey-button">Supprimer le partage</button>';
            }
            if($journey->isPublic() && !$journey->getCreator() == $_SESSION["id"]) {
                echo '<button id="btn-modal-save" class="journey-button">Enregistrer</button>';
            }
            ?>
        </div>
        <br />
    </div>
</main>
<!-- Modal for save journey -->
<div id="modal-save" class="modal">
<!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
        <span id="modal-colser" class="close" onclick="closeModal('save'); changeValue('public', 0); changeText('btn-save-journey', 'Enregistrer')">&times;</span>
        <h2>Informations du parcours</h2>
    </div>
    <div class="modal-body body-80">
        <form action="?page=saveJourney" method="post">
            <div class="form-group group-column">
                <label for="journey-name">Nom du parcours</label>
                <input type="text" name="journey-name" id="journey-name" required>
            </div>
            <div class="form-group group-column">
                <label for="journey-description">Description du parcours</label>
                <textarea name="journey-description" id="journey-description" cols="30" rows="10" required></textarea>
            </div>
            <input type="hidden" name="public" id="public" value="0">
            <button type="submit" class="black-text" id="btn-save-journey">Enregistrer</button>
        </form>
    </div>
</div>
