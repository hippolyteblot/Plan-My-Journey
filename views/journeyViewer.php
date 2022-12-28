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
    <link rel="stylesheet" href="<?= PATH_CSS ?>commentary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>generateJourney.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>modal.js"></script>    
    <script defer src="<?= PATH_SCRIPTS ?>libMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>interactiveMap.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>calculateDistance.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>journeyViewer.js"></script>
    <script defer src="<?= PATH_SCRIPTS ?>commentary.js"></script>
</head>
<div id="background-img"></div>
<main id="accueil">
    <article id="journey-presentation">
        <div class="glass journey-container">
            <div class="journey-header">
                <h1><?= $journey->getTitle() ?> - <?= $journey->getPlace() ?></h1>
                <?php $fav = $journey->alreadyFavorite($_SESSION['id']) ? "" : "-o"; ?>
                <form action="?page=journeyViewer&id=<?= $journey->getId() ?>" method="post">
                    <button type="submit" class="fav-btn fa fa-heart<?= $fav ?>" id="fav-btn"></button>
                    <input type="hidden" name="favorite" value="<?= $journey->getId() ?>">
                </form>
            </div>
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
                $hide = $journey->canModify($_SESSION['id']) ? "" : "hidden";
                foreach($journeySchema as $moment) {
                ?>
                    <?php if($iter != 0) { ?>
                    <div class="travel-info">
                        <p class="travel-info-text">Distance : <span class="distance" id="distance-<?= $iter ?>"></span></p>
                        <p class="travel-info-text">Durée : <span class="duration" id="duration-<?= $iter ?>"></span></p>
                    </div>
                    <article class="straight"></article>
                    <?php } ?>
                    <div class="step-container">
                        <div class="change-step arrow-left <?= $hide ?>"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></div>
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
                                    <input type="hidden" name="candidate-id" value="<?= $candidate["step_id"] ?>">                           
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
                                    <input type="hidden" name="candidate-id" value="<?= $candidate["step_id"] ?>">                        
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
                        <button class="change-step arrow-right <?= $hide ?>"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></button>
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
                <?php
                if ($journey->getCreator() == $_SESSION["id"] && $journey->isPublic() == 1) {
                    echo '<p class="for-modif">Pour modifier votre parcours, annulez le partage</p>';
                }
                ?>
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
    </article>
    
    <article id="commentary-container" class="glass">
        <h2>Commentaires</h2>
        <div class="commentaries-list">
            <?php
            foreach($journey->getCommentaries() as $commentary) {
                ?>
                <div class="commentary glass">
                    <div class="info">
                        <p class="content"><?= $commentary['content'] ?></p>
                        <p class="author">Par <a class="profile-link" href="?page=profil&user=<?= $commentary['user_id'] ?>"><?= $commentary['firstname'] . " " . $commentary['lastname'] ?></a> le <?= $commentary['date'] ?></p>
                    </div>

                    <div class="actions">
                        <?php if($commentary['user_id'] != $_SESSION["id"]) { ?>
                            <button class="report-btn" name="reportCommentary" class="journey-button" title="Signaler" onclick="openModal('report')" value="<?= $commentary["commentary_id"] ?>"><i class="fa fa-warning"></i></button>                            
                        <?php } ?>

                        <?php if($journey->getCreator() == $_SESSION["id"] || $commentary['user_id'] == $_SESSION["id"]) { ?>
                            <form method="post">
                                <input type="hidden" name="commentaryId" value="<?= $commentary['commentary_id'] ?>">
                                <button type="submit" name="deleteCommentary" class="journey-button" title="Supprimer"><i class="fa fa-trash-o"></i></button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            if(count($journey->getCommentaries()) == 0) {
                echo "<p>Aucun commentaire pour le moment</p>";
            }
            ?>
        </div>
        <form class="footer-commentary" method="post">
            <textarea name="commentary" id="commentary" placeholder="Votre commentaire"></textarea>
            <input type="submit" value="Envoyer" name="commentaryBtn" id="btn-modal-share" class="journey-button">
        </form>
    </article>
</main>


<!-- Modal for report -->
<div id="modal-report" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Signaler un commentaire</h2>
        </div>
        <div class="modal-body">
            <p>Êtes-vous sûr de vouloir signaler ce commentaire ?</p>
        </div>
        <div class="modal-footer">
            <form action="?page=journeyViewer" method="post">
                <input type="hidden" name="commentaryIdForReport" value="">
                <input type="submit" value="Oui" name="reportCommentary">
                <input type="button" value="Non" onclick="closeModal('report')">
            </form>
        </div>
    </div>
</div>