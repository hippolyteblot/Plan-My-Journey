<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>generateJourney.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>interactiveMap.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>notation.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>calculateDistance.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>generateJourney.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>libMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>interactiveMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>modal.js"></script>

</head>
<div id="background-img">
</div>
<main id="accueil">

    <article id="journey-presentation">
    <div class="glass generatedJourney">
        <h1>Voici votre parcours touristique à <?= $_SESSION['candidates'][0]['formatted_address'] ?> !</h1>
        <form action="?page=saveJourney" method="post">
            <?php
            $_SESSION['journeySchema'] = $journeySchema;
            ?>
            <div class="steps">
                <div class="vertical-line"></div>
                <div style="display: flex; flex-direction: column; width: 100%">
                    <?php
                    $iter = 1;
                    foreach ($journeySchema as $step) {
                        if ($step["type"] == "D") {
                    ?>
                    <?php if($iter != 0) { ?>
                        <div class="travel-info">
                            <p class="travel-info-text">Distance : <span class="distance" id="distance-<?= $iter ?>"></span></p>
                            <p class="travel-info-text">Durée : <span class="duration" id="duration-<?= $iter ?>"></span></p>
                        </div>
                    <?php } ?>
                    <?php
                        
                        $iter++;
                    
                    ?>
                        <article class="straight">
                        </article>
                        <?php
                        } else if ($step["type"] == "A" || $step["type"] == "R") {
                        ?>
                            <div class="step-container">
                                <div class="change-step arrow-left"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></div>

                                <article class="step">
                                    <h2><?= $step["name"] ?> - <?= $step["start"] . " à " . $step["end"] ?></h2>
                                    <div class="candidates">
                                        <div class="step-infos active" data-lat="<?= $step["candidates"][0]["geometry"]["location"]["lat"] ?>" data-lng="<?= $step["candidates"][0]["geometry"]["location"]["lng"] ?>" data-text="<?= $step["candidates"][0]["name"] ?>">
                                            <p"><?= $step["candidates"][0]["name"] ?></p>
                                                <p><?= $step["candidates"][0]["vicinity"] ?></p>
                                                <input type="hidden" name="candidate-id" value="<?= $step["candidates"][0]["place_id"] ?>">

                                                <span class="rating">
                                                    <?php
                                                    if (isset($step["candidates"][0]["rating"])) {
                                                        echo "<p name='step_rate_0' value='" . $step["candidates"][0]["rating"] . "'>" . $step["candidates"][0]["rating"] . " ";

                                                        for ($j = 0; $j < 5; $j++) {
                                                            if ($j < $step["candidates"][0]["rating"]) {
                                                    ?>
                                                                <span class="fa fa-star"></span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="fa fa-star-o"></span>
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
                                        for ($i = 1; $i < count($step["candidates"]); $i++) {
                                        ?>
                                            <div class="step-infos" value="<?= $step["candidates"][$i]["place-id"] ?>" data-lat="<?= $step["candidates"][$i]["geometry"]["location"]["lat"] ?>" data-lng="<?= $step["candidates"][$i]["geometry"]["location"]["lng"] ?>" data-text="<?= $step["candidates"][$i]["name"] ?>">
                                                <p><?= $step["candidates"][$i]["name"] ?></p>
                                                <p><?= $step["candidates"][$i]["vicinity"] ?></p>
                                                <input type="hidden" name="candidate-id" value="<?= $step["candidates"][$i]["place_id"] ?>">

                                                <span class="rating">
                                                    <?php
                                                    if (isset($step["candidates"][$i]["rating"])) {
                                                        echo "<p name='step_rate_$i' value='" . $step["candidates"][$i]["rating"] . "'>" . $step["candidates"][$i]["rating"] . " ";

                                                        for ($j = 0; $j < 5; $j++) {
                                                            if ($j < $step["candidates"][$i]["rating"]) {
                                                    ?>
                                                                <span class="fa fa-star checked"></span>
                                                            <?php
                                                            } else {
                                                            ?>
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
                                    </div>
                                </article>
                                <button class="change-step arrow-right"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </form>
        <div class="info-container">
            
            <div class="button-container">
                <button id="btn-modal-share" class="journey-button">Partager</button>
                <button id="btn-modal-save" class="journey-button">Enregistrer</button>
                <button id="re-generate" class="journey-button">Re-générer</button>
            </div>
            <div class="journey-footer">
                <div>
                    <p>Durée : <?= soustractTime($journeySchema[0]["start"], $journeySchema[count($journeySchema) - 1]["end"]) ?></p>
                    <p>Distance : <span id="total-distance">0 km</span></p>
                </div>
            </div>
        </div>
        <br />
    </div>
    <div class="map glass" id="map">

    </div>
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
            <form action="?page=saveJourney" method="post" class="saver-form">
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

</div>