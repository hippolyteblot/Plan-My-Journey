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
<div id="background-img">
</div>
<main id="accueil">
    
    <div class="glass">
        <h1>Voici votre parcours touristique à <?= $_SESSION['candidates'][0]['formatted_address'] ?> !</h1>
    <form action="?page=saveJourney" method="post">
        <?php
        $_SESSION['journeySchema'] = $journeySchema;
        ?>
        <div style="display: flex">
        <div class="vertical-line"></div>
        <div style="display: flex; flex-direction: column; width: 100%">
        <?php
        foreach($journeySchema as $step) {
            if($step["type"] == "D") {
                ?>
                <article class="straight">
                </article>
                <?php
            }
            else if ($step["type"] == "A" || $step["type"] == "R") {
                ?>
                <div class="step-container">
                    <div class="change-step arrow-left"><img src="<?= PATH_IMAGES ?>arrow.svg" alt="arrow-right"></div>

                    <article class="step">
                        <h2><?= $step["name"] ?> - <?= $step["start"] . " à " . $step["end"] ?></h2>
                        <div class="candidates">
                            <div class="step-infos active">
                                <p"><?= $step["candidates"][0]["name"] ?></p>
                                <p><?= $step["candidates"][0]["vicinity"] ?></p>
                                <input type="hidden" name="candidate-id" value="<?= $step["candidates"][0]["place_id"] ?>">                             

                                <span class="rating">
                                <?php
                                    if(isset($step["candidates"][0]["rating"])) {
                                        echo "<p name='step_rate_0' value='".$step["candidates"][0]["rating"]."'>" . $step["candidates"][0]["rating"] . " ";
                                        
                                        for($j = 0; $j < 5; $j++) {
                                            if($j < $step["candidates"][0]["rating"]) {
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
                            for($i = 1; $i < count($step["candidates"]); $i++) {
                                ?>
                                <div class="step-infos" value="<?=$step["candidates"][$i]["place-id"]?>">
                                    <p><?= $step["candidates"][$i]["name"] ?></p>
                                    <p><?= $step["candidates"][$i]["vicinity"] ?></p>
                                    <input type="hidden" name="candidate-id" value="<?= $step["candidates"][$i]["place_id"] ?>">
                                    
                                    <span class="rating">
                                        <?php
                                        if(isset($step["candidates"][$i]["rating"])) {
                                            echo "<p name='step_rate_$i' value='".$step["candidates"][$i]["rating"]."'>" . $step["candidates"][$i]["rating"] . " ";
                                            
                                            for($j = 0; $j < 5; $j++) {
                                                if($j < $step["candidates"][$i]["rating"]) {
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
    <div class="button-container">
        <button id="re-generate" class="journey-button">Re-générer</button>
        <button id="btn-modal-share" onclick="openModal('save'); changeValue('public', 1); changeText('btn-save-journey', 'Partager')" class="journey-button">Partager</button>    
        <button id="btn-modal-save" onclick="openModal('save')" class="journey-button">Enregistrer</button>
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

