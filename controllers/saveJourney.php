<?php



$ids = explode(",", $_POST["activeSteps"]);

echo "<pre>";
print_r($ids);
echo "</pre>";

require_once(PATH_MODELS . 'stepManagement.php');

$journeySchema = $_SESSION["journeySchema"];

$idTab = array();
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

$journeyId = insertNewJourneyInDatabase($journeySchema, $placeId, $_SESSION['email'], 1, "default title", "default description");

foreach($journeySchema as $step){
    if($step["type"] != "D"){
        foreach($step["candidates"] as $candidate){
            // if the candidate is selected
            if(in_array($candidate["place_id"], $ids)){
                // We insert the candidate in the database
                linkSteptoJourney($journeyId, $candidate["place_id"], 1);
            } else {
                linkSteptoJourney($journeyId, $candidate["place_id"], 0);
            }
        }
    }
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";