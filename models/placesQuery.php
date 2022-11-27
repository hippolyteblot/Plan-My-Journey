<?php

function getPlacesFromPrimaryType($primaryType, $location, $radius)
{
    $query = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $location['lat'] . "," . $location['lng'] . "&radius=" . $radius . "&type=" . $primaryType . "&key=" . KEY;

    $result = file_get_contents($query);

    $result = json_decode($result, true);

    $places = array();

    foreach ($result['results'] as $place) {
        $places[] = $place;
    }

    return $places;
}

function getPlacesFromSecondaryType($secondaryType, $location, $radius)
{
    $query = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $location['lat'] . "," . $location['lng'] . "&radius=" . $radius . "&keyword=" . $secondaryType . "&key=" . KEY;

    $result = file_get_contents($query);

    $result = json_decode($result, true);

    $places = array();

    foreach ($result['results'] as $place) {
        $places[] = $place;
    }

    return $places;
}