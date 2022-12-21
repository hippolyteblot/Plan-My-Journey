

<div class="journey-preview glass" id="<?= $journey->getId() ?>" data-journey-id="<?= $journey->getId() ?>" data-date="<?= $journey->getDate() ?>" data-rating="<?= $journey->getRating() ?>">
    <div class="journey-header">
        <h3 class="place-name"><?= $journey->getPlace() ?></h3>
        <h3><?= $journey->getTitle() ?></h3>
    </div> 
    <div class="journey-body">
        <?php
        foreach($journey->getSchema() as $moment) {
            ?>
            <div class="journey-step glass">
                <div class="journey-step-header">
                    <h4><?= $moment["type_name"]?></h4>
                    <p><?= substr($moment["candidates"][0]["start"], 0, 5) . " - " . substr($moment["candidates"][0]["end"], 0, 5) ?></p>
                </div>
                <div class="journey-step-body">
                    <div class="journey-step-infos">
                        <p><?= $moment["candidates"][0]["step_name"]?></p>
                        <p><?= $moment["candidates"][0]["step_vicinity"]?></p>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
    <div class="journey-footer">
        <div>
            <p>Durée : <?= $journey->getDuration() ?> </p>
            <p>Distance : <?= $journey->getDistance() ?> km</p>
        </div> 
        <div>
            <p>Note : <?= $journey->getRating() ?></p>
            <p>Crée par : <?= "<a class='profile-link' href='?page=profile&user=" . $journey->getCreator() . "'>" . $journey->getCreatorName() . "</a>" ?></p>
        </div>
    </div>
</div>