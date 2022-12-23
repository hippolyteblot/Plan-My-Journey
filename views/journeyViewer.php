<?php require_once(PATH_VIEWS . 'header.php'); ?>
<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>generateJourney.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>notation.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>modal.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>glassmorphism.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>form.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>interactiveMap.css">
    <link rel="stylesheet" href="<?= PATH_CSS ?>journeyPreview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>generateJourney.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>modal.js"></script>    
    <script defer src="<?= PATH_SCRIPTS ?>libMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>interactiveMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>calculateDistance.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>journeyViewer.js"></script>
</head>
<div id="background-img"></div>
<main id="accueil">
    <div class="glass journey-container">
        <h1><?= $journey->getTitle() ?> - <?= $journey->getPlace() ?></h1>
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
            $iter = 0;
            foreach($journeySchema as $moment) {
            ?>
                <?php if($iter != 0) { ?>
                <div class="travel-info">
                    <p class="travel-info-text">Distance : <span class="distance" id="distance-<?= $iter ?>"></span></p>
                    <p class="travel-info-text">Durée : <span class="duration" id="duration-<?= $iter ?>"></span></p>
                </div>
                <?php } ?>
                <div class="step-container">
                    <div class="change-step arrow-left"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></div>
                    <article class="step">
                    <h2><?= $moment["type_name"] ?> - <?= substr($moment["candidates"][0]["start"], 0, 5) ?> à <?= substr($moment["candidates"][0]["end"], 0, 5) ?></h2>
                    <div class="candidates">
                    <?php
                    $lastStep = null;
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
                                            <span class="fa fa-star"></span>
                                            <?php
                                        } else { ?>
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
                        } else { ?>
                            <div class="step-infos" data-lat="<?= $candidate["step_lat"] ?>" data-lng="<?= $candidate["step_lng"] ?>" data-text="<?= $candidate["step_name"] ?>">
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
                                            <span class="fa fa-star"></span>
                                            <?php
                                        } else { ?>
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
                        }

                    ?>
                <?php
                    
                    }
                    ?>
                    </article>
                    <button class="change-step arrow-right"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></button>
                </div>

            <?php
            $iter++;
                }
                ?>
                
            </div>
            
        </div>
        </form>
        <div class="info-container">
            
        <form method="post">
            <!-- Interactive notation with stars -->
            <div class="notation-container">
                <div class="notation notation-interactive">
                    <button type="submit" name="notationBtn" id="btn-modal-share" class="journey-button">Noter</button>
                    <input type="radio" name="notation" id="etoile5" value="5">
                    <label for="etoile5" title="5 étoiles" class="fa fa-star"></label>
                    <input type="radio" name="notation" id="etoile4" value="4">
                    <label for="etoile4" title="4 étoiles" class="fa fa-star"></label>
                    <input type="radio" name="notation" id="etoile3" value="3">
                    <label for="etoile3" title="3 étoiles" class="fa fa-star"></label>
                    <input type="radio" name="notation" id="etoile2" value="2">
                    <label for="etoile2" title="2 étoiles" class="fa fa-star"></label>
                    <input type="radio" name="notation" id="etoile1" value="1">
                    <label for="etoile1" title="1 étoile" class="fa fa-star"></label>
                    <input type="hidden" name="oldNotation" value="<?= $journey->getUserNotation($_SESSION["id"]) ?>">
                </div>
                
            </div>
            <div class="button-container">
                <?php
                if(!$journey->isPublic() == 1 && $journey->getCreator() == $_SESSION["id"]) {
                    echo '<input type="submit" value="Partager" name="share" id="btn-modal-share" class="journey-button"></button>';
                }
                if($journey->isPublic() == 1 && $journey->getCreator() == $_SESSION["id"]) {
                    echo '<input type="submit" value="Annuler le partage" name="private" id="btn-modal-share" class="journey-button"></button>';
                }
                if($journey->getCreator() == $_SESSION["id"]) {
                    echo '<input type="submit" value="Supprimer" name="delete" id="btn-modal-share" class="journey-button"></button>';
                }
                if($journey->isPublic() == 1 && !($journey->getCreator() == $_SESSION["id"]) && !$journey->alreadySaved($_SESSION["id"])) {
                    echo '<input type="submit" name="save" value="Enregistrer" id="btn-modal-save" class="journey-button"></button>';
                }
                if($journey->isPublic() == 1 && !($journey->getCreator() == $_SESSION["id"]) && $journey->alreadySaved($_SESSION["id"])) {
                    echo '<input type="submit" name="unsave" value="Supprimer" id="btn-modal-save" class="journey-button"></button>';
                }
                if(!$journey->isPublic() == 1 && $journey->getCreator() == $_SESSION["id"]) {
                    echo '<input type="submit" name="modify" value="Modifier" id="btn-modal-save" class="journey-button"></button>';
                }
                ?>
            </div>
        </form>
        <div class="journey-footer">
            <div>
                <p>Durée : <?= $journey->getDuration() ?> </p>
                <p id="total-distance">Distance : <?= $journey->getDistance() ?> km</p>

                <p>Note :
                    <?php
                    $count = 0;
                    for($i = 0; $i < $journey->getRating(); $i++) {
                        echo "<span class='fa fa-star'></span>";
                        $count++;
                    }
                    for($i = 0; $i < 5 - $count; $i++) {
                        echo "<span class='fa fa-star-o'></span>";
                    }
                    ?>
                </p>
                    
                <p>Crée par : <?= "<a class='profile-link' href='?page=profile&user=" . $journey->getCreator() . "'>" . $journey->getCreatorName() . "</a>" ?></p>
            </div>
        </div>
        
        </div>
        
        <br />
    </div>
    <div class="map glass" id="map">

    </div>
</main>
