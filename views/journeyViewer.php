<?php require_once(PATH_VIEWS . 'header.php'); ?>
<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>generateJourney.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>notation.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>form.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>interactiveMap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>generateJourney.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>modal.js"></script>    
    <script defer src="<?= PATH_SCRIPTS ?>libMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>interactiveMap.js"></script>
</head>
<div id="background-img"></div>
<main id="accueil">
    <div class="glass journey-container">
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
                            <div class="step-infos active" data-lat="<?= $candidate["step_lat"] ?>" data-lng="<?= $candidate["step_lng"] ?>" data-text="<?= $candidate["step_name"] ?>">
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
        <form method="post">
            <?php
            if(!$journey->isPublic() && $journey->getCreator() == $_SESSION["id"]) {
                echo '<input type="submit" value="Partager" name="share" id="btn-modal-share" class="journey-button"></button>';
            }
            if($journey->isPublic() && $journey->getCreator() == $_SESSION["id"]) {
                echo '<input type="submit" value="Annuler le partage" name="private" id="btn-modal-share" class="journey-button"></button>';
            }
            if($journey->getCreator() == $_SESSION["id"]) {
                echo '<input type="submit" value="Supprimer" name="delete" id="btn-modal-share" class="journey-button"></button>';
            }
            if($journey->isPublic() && !$journey->getCreator() == $_SESSION["id"]) {
                echo '<input type="submit" name="save" value="Enregistrer" id="btn-modal-save" class="journey-button"></button>';
            }
            if(!$journey->isPublic() && $journey->getCreator() == $_SESSION["id"]) {
                echo '<input type="submit" name="modify" value="Modifier" id="btn-modal-save" class="journey-button"></button>';
            }
            ?>
        </form>
        </div>
        <br />
    </div>
    <div class="map glass" id="map">

    </div>
</main>