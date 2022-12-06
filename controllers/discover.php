<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$pageName = "Discover";
require_once(PATH_MODELS . 'discover.php');
$journey_id =  getDiscover();
$j = 0;
foreach ($journey_id as $journey) {
    $compose = $journey['journey_id'];
    $steps[$j] = getCompose($compose);
    $j++;
    $etape = array();
    $i = 0;
    foreach ($steps as $step) {
        foreach ($step as $step_id) {
            $etape[$i] = getStep($step_id['step_id']);
            $i++;
        }
    }
}
$loc = $etape[0][0]['step_vicinity'];
//garder suelement la ville
$loc = explode(',', $loc);
//si loc contient au moins un chiffre explode
if (preg_match('/[0-9]/', $loc[0])) {
    $loc = explode(' ', $loc[1]);
}
echo(" <pre>  ");
print_r($journey_id);
echo(" </pre>  ");
echo($etape[0][0]['step_vicinity']);
require_once(PATH_VIEWS .  'discover.php');
