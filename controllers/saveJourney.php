<?php



$ids = explode(",", $_POST["activeSteps"]);

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

$journeyId = insertNewJourneyInDatabase($journeySchema, $placeId, $_SESSION['email'], 1, $_POST["journeyName"], $_POST["journeyDescription"], (int) $_POST["public"]);

foreach($journeySchema as $step){
    if($step["type"] != "D"){
        foreach($step["candidates"] as $candidate){
            // if the candidate is selected
            if(in_array($candidate["place_id"], $ids)){
                // We insert the candidate in the database
                linkSteptoJourney($journeyId, $candidate["place_id"], 1, $step["start"], $step["end"], $step["id"]);
            } else {
                linkSteptoJourney($journeyId, $candidate["place_id"], 0, $step["start"], $step["end"], $step["id"]);
            }
        }
    }
}

// Redirect to the journey page
header('Location: index.php?page=myJourneys');