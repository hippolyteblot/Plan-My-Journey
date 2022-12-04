<?php

require_once(PATH_MODELS . 'stepManagement.php');

$journeySchema = $_SESSION["journeySchema"];


$firstStep = $journeySchema[0];


// Foreach candidate
foreach($journeySchema as $step){
    if($step["type"] != "D"){
        foreach($step["candidates"] as $candidate){
            // We insert the candidate in the database
            insertStepInDatabase($candidate);
        }
    }
}





echo "<pre>";
print_r($firstStep);
echo "</pre>";
