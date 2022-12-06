<?php require_once(PATH_VIEWS . 'header.php');

?>

<head>
    <link rel="stylesheet" href="<?= PATH_CSS ?>discover.css">
</head>
<div id="corps">
    <h1>Discover</h1>
    <?php foreach ($journey_id as $journey) { 
        echo $journey['journey_id'];
        ?>
    <div id="container">
        <div class=globalJourney>
        <div class="journeyPost">
            <div class="image">
                <h2>
                <?= $loc[1]; ?>
                </h2>
                <img src="<?= PATH_IMAGES ?>accueil-bg.jpg" alt="photo du parcours"> <!-- image du parcours -->
            </div>
            <div class="description">
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis assumenda ea illum dolorem
                    ducimus numquam minima molestias, quidem tempora? Sapiente et accusantium non incidunt. Optio atque
                    accusamus voluptates placeat est?
                </p>
            </div>
            <div class="containerSteps">
                <div class="steps">
                    <ul>
                        <?php 
                            foreach ($etape as $step) {
                                foreach($step as $ste) {
                                    ?> <li> <?php
                                    echo $ste['step_name'];
                                    ?> </li> <?php
                                }
                            }
                        ?>
                        

                    </ul>
                </div>
                

            </div>
            



        </div>
        <div class=footer>
                <p>parcours créé par : </p>
                <p>date de création : <?=
                    $journey['creation_date'];
                ?> </p>
                <div class="journeyAction">
                    <div class="action">
                        <a href="index.php?page=parcours"><span class="material-symbols-outlined">
                                thumb_up
                            </span></a>
                    </div>
                    <div class="action">
                        <a href="index.php?page=discover"><span class="material-symbols-outlined">
                                chat_bubble
                            </span></a>
                    </div>

                </div>
            </div>
        </div>
        

    </div>
    <?php } ?>


</div>
