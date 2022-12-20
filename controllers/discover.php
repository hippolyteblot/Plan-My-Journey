<?php


$pageName = "Découvrir";
require_once(PATH_MODELS . 'discover.php');
require_once(PATH_MODELS . 'Journey.php');
require_once(PATH_MODELS . 'locationQuery.php');

if(isset($_POST['location'])) {
    $location = $_POST['location'];
    $location = str_replace(' ', '+', $location);
    $candidates = getCandidates($location);
    $journey_id = getDiscoverFromLocation($candidates[0]['name']);
} else {
    $journey_id = getDiscover();
}





$journeysArray = array();
foreach ($journey_id as $journey) {
    $journeysArray[] = new Journey($journey['journey_id']);
}

/*
$i = 0;

foreach ($journey_id as $journey) {
    $id = $journey['journey_id'];
    $steps = getCompose($id);
    $etape = array();
    foreach ($steps as $step) {
        foreach ($step as $step_id) {
            $etape[] = getStep($step_id);
        }
    }
    $journey_id[$i]['steps'] = $etape;
    $i++;
}*/

require_once(PATH_VIEWS .  'discover.php');
