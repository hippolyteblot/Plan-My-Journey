<?php

function getCandidates($locationName)
{
    $locationName = str_replace(' ', '+', $locationName);

    $query = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=" . $locationName . "&inputtype=textquery&fields=formatted_address,name,geometry,type&key=" . KEY;

    $result = file_get_contents($query);

    $result = json_decode($result, true);

    $candidates = array();

    foreach ($result['candidates'] as $candidate) {
        // If the candidate is a city
        if (in_array('locality', $candidate['types'])) {
            $candidates[] = $candidate;
        }
    }

    return $candidates;
}