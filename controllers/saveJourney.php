<?php

require_once(PATH_MODELS . 'stepManagement.php');

$journeySchema = $_SESSION["journeySchema"];

// Foreach candidate
foreach($journeySchema as $step){
    if($step["type"] != "D"){
        foreach($step["candidates"] as $candidate){
            // We insert the candidate in the database
            insertStepInDatabase($candidate);
        }
    }
}

$place = $_SESSION["parameters"]["place"];
$place = json_decode($place, true);

$placeId = insertNewPlaceInDatabase($place);

insertNewJourneyInDatabase($journeySchema, $placeId, $_SESSION['email'], 1, "default title", "default description");
echo "<pre>";
print_r($_SESSION);
echo "</pre>";