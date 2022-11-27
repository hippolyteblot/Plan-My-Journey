<?php require_once(PATH_VIEWS . 'header.php'); ?>

<head>
  <link rel="stylesheet" href="<?= PATH_CSS ?>parametersSelection.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>generateJourney.css">
  <link rel="stylesheet" href="<?= PATH_CSS ?>notation.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script defer src="<?= PATH_SCRIPTS ?>script.js"></script>
  <script defer src="<?= PATH_SCRIPTS ?>step.js"></script>

</head>
<div id="background-img">
</div>
<main id="accueil">
    <h1>Voici votre parcours touristique à <?= $_SESSION['candidates'][0]['formatted_address'] ?> !</h1>
    <div class="glass">
    <form action="?page=preferencesSelection" method="post">
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
                        <h2><?= $step["name"] ?></h2>
                        <div class="candidates">
                            <div class="step-infos active">
                                <p><?= $step["candidates"][0]["name"] ?></p>
                                <p><?= $step["candidates"][0]["vicinity"] ?></p>
                                <span class="rating">
                                <?php
                                    if(isset($step["candidates"][0]["rating"])) {
                                        echo $step["candidates"][0]["rating"] . " ";
                                        
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
                                <div class="step-infos">
                                    <p><?= $step["candidates"][$i]["name"] ?></p>
                                    <p><?= $step["candidates"][$i]["vicinity"] ?></p>
                                    <span class="rating">
                                        <?php
                                        if(isset($step["candidates"][$i]["rating"])) {
                                            echo $step["candidates"][$i]["rating"] . " ";
                                            
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
    <div class="button-container">
            <button id="re-generate" class="journey-button">Re-générer</button>
            <button type="submit" class="journey-button">Partager</button>
            <button type="submit" class="journey-button">Enregistrer</button>
        </div>
    </form>
    <br />
  </div>
</main>
