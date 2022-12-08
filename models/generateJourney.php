<?php

include_once(PATH_MODELS . 'placesQuery.php');

function sortPreferences($preferences) {
    $activities = array();
    $restaurants = array();
    foreach($preferences as $preference){
        // If its structure_type is A (Activity), we add it to the activities array
        if($preference["structure_type"] == 'A'){
            if(isset($preference["primary_type_name"])) {
                array_push($activities, array('id' => $preference['type_id'], 'name' => $preference['primary_type_name'], 'P/S' => 'P'));
            } else {
                array_push($activities, array('id' => $preference['type_id'], 'name' => $preference['secondary_type_name'], 'P/S' => 'S'));
            }
        } else {
            // Else, we add it to the restaurants array
            if(isset($preference["primary_type_name"])) {
                array_push($restaurants, array('id' => $preference['type_id'], 'name' => $preference['primary_type_name'], 'P/S' => 'P'));
            } else {
                array_push($restaurants, array('id' => $preference['type_id'], 'name' => $preference['secondary_type_name'], 'P/S' => 'S'));
            }
        }
    }
    return array('activities' => $activities, 'restaurants' => $restaurants);
}

function buildSchema($start, $end, $activities, $restaurants, $wantRestaurant) {

    $journeySchema = array();

    $progression = $start;
    while ((compareDate($progression, "12:00") == 1 && compareDate($progression, "14:00") && compareDate(addTime($progression, "01:00"), $end) == -1 ) || compareDate(addTime($progression, "01:00"), $end) == -1) {
        // If its lunch time or dinner time
        if ($wantRestaurant && compareDate($progression, "12:00") == 1 && compareDate($progression, "14:00") == -1) {
            // We select a type and delete it from the restaurants array
            $restaurant = $restaurants[array_rand($restaurants)];
            unset($restaurants[array_search($restaurant, $restaurants)]);
            
            array_push($journeySchema, array('type' => 'R', 'id' => $restaurant['id'], 'name' => $restaurant['name'], 'start' => $progression, 'end' => addTime($progression, "01:00"), 'P/S' => $restaurant['P/S']));
            array_push($journeySchema, array('type' => 'D', 'id' => null, 'name' => null, 'start' => addTime($progression, "01:00"), 'end' => addTime($progression, "01:30"), 'P/S' => null));
            $progression = addTime($progression, "01:30");
        } else {
            // Else, we add an activity
            $activity = $activities[array_rand($activities)];
            unset($activities[array_search($activity, $activities)]);

            array_push($journeySchema, array('type' => 'A', 'id' => $activity['id'], 'name' => $activity['name'], 'start' => $progression, 'end' => addTime($progression, "02:00"), 'P/S' => $activity['P/S']));
            array_push($journeySchema, array('type' => 'D', 'id' => null, 'name' => null, 'start' => addTime($progression, "02:00"), 'end' => addTime($progression, "02:30"), 'P/S' => null));
            $progression = addTime($progression, "02:30");
        }
    }

    unset($journeySchema[count($journeySchema) - 1]);

    return $journeySchema;
}

function addTime($a, $b) {
    // Date is "hh:mm"
    $a = explode(':', $a);
    $b = explode(':', $b);
    // We add the minutes
    $minutes = $a[1] + $b[1];
    $hours = $a[0] + $b[0];
    // If minutes are greater than 60, we add an hour
    if ($minutes >= 60) {
        $minutes -= 60;
        $hours++;
    }
    // If hours are greater than 24, we add a day
    if ($hours >= 24) {
        $hours -= 24;
    }
    // We return the result
    $newDate = $hours . ':' . $minutes;
    // Add 0 before and after if they are not present
    $splited = explode(':', $newDate);
    if (strlen($splited[0]) == 1) {
        $splited[0] = '0' . $splited[0];
    } 
    if (strlen($splited[0]) == 0) {
        $splited[0] = '00';
    }
    if (strlen($splited[1]) == 1) {
        $splited[1] = '0' . $splited[1];
    }
    if (strlen($splited[1]) == 0) {
        $splited[1] = '00';
    }
    return $splited[0] . ':' . $splited[1];
}

function compareDate($a, $b) {
    // Date is "hh:mm"
    $a = explode(':', $a);
    $b = explode(':', $b);
    // We compare the hours
    if ($a[0] < $b[0]) {
        return -1;
    } else if ($a[0] > $b[0]) {
        return 1;
    } else {
        // If hours are equal, we compare the minutes
        if ($a[1] < $b[1]) {
            return -1;
        } else if ($a[1] > $b[1]) {
            return 1;
        } else {
            return 0;
        }
    }
}

function getCandidates($journeySchema, $activities, $restaurants, $location) {

    for($i = 0; $i < count($journeySchema); $i++){
        if($journeySchema[$i]['type'] != 'D'){
            if($journeySchema[$i]['P/S'] == 'P'){
                $journeySchema[$i]['candidates'] = getPlacesFromPrimaryType($journeySchema[$i]['id'], $location, 10000);
                // Loop for avoiding an empty array -> we replace the type by a new one
                $security = 0;
                while(count($journeySchema[$i]['candidates']) == 0){
                    $newType = null;
                    if($journeySchema[$i]['type'] == 'A'){
                        $newType = $activities[array_rand($activities)];
                    } else {
                        $newType = $restaurants[array_rand($restaurants)];
                    }
                    unset($journeySchema[$i]['candidates']);
                    $journeySchema[$i]['id'] = $newType['id'];
                    $journeySchema[$i]['name'] = $newType['name'];
                    $journeySchema[$i]['P/S'] = $newType['P/S'];
                    if($journeySchema[$i]['P/S'] == 'P'){
                        $journeySchema[$i]['candidates'] = getPlacesFromPrimaryType($journeySchema[$i]['id'], $location, 10000);
                    } else {
                        $journeySchema[$i]['candidates'] = getPlacesFromSecondaryType($journeySchema[$i]['id'], $location, 10000);
                    }
                    $security++;
                    if($security > 5){
                        break;
                    }
                }
            } else {
                $journeySchema[$i]['candidates'] = getPlacesFromSecondaryType($journeySchema[$i]['id'], $location, 10000);
                // Loop for avoiding an empty array -> we replace the type by a new one
                $security = 0;
                while(count($journeySchema[$i]['candidates']) == 0){
                    $newType = null;
                    if($journeySchema[$i]['type'] == 'A'){
                        $newType = $activities[array_rand($activities)];
                    } else {
                        $newType = $restaurants[array_rand($restaurants)];
                    }
                    unset($journeySchema[$i]['candidates']);
                    $journeySchema[$i]['id'] = $newType['id'];
                    $journeySchema[$i]['name'] = $newType['name'];
                    $journeySchema[$i]['P/S'] = $newType['P/S'];
                    if($journeySchema[$i]['P/S'] == 'P'){
                        $journeySchema[$i]['candidates'] = getPlacesFromPrimaryType($journeySchema[$i]['id'], $location, 10000);
                    } else {
                        $journeySchema[$i]['candidates'] = getPlacesFromSecondaryType($journeySchema[$i]['id'], $location, 10000);
                    }
                    $security++;
                    if($security > 5){
                        break;
                    }
                }
            }
            
        }
    }

    return $journeySchema;
}

// Get data from local (for testing)
function getCandidatesFromJSON($filePath) {
    $journeySchema = json_decode(file_get_contents($filePath), true);
    return $journeySchema;
}

function filterFromConstraints($journeySchema, $budget) {
    // For each place, we check if it is in the budget (1 or 2 or 3 $)
    for($i = 0; $i < count($journeySchema); $i++){
        if($journeySchema[$i]['type'] != 'D'){
            $candidates = $journeySchema[$i]['candidates'];
            $newCandidates = array();
            for($j = 0; $j < count($candidates); $j++){
                if(!isset($candidates[$j]['price_level']) || $candidates[$j]['price_level'] <= $budget){
                    array_push($newCandidates, $candidates[$j]);
                }
            }
            $journeySchema[$i]['candidates'] = $newCandidates;
        }
    }
    return $journeySchema;
}