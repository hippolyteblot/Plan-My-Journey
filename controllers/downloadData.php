<?php

// This file return the data of the user with a txt file

$id = $_SESSION['id'];

// Get the data of the user
include_once(PATH_MODELS.'Connexion.php');

$database = Connexion::getInstance()->getBdd();
$query = $database->prepare('SELECT * FROM user WHERE user_id = ?');
$query->execute(array($id));
$result = $query->fetch();

$preferences = array();
$query = $database->prepare('SELECT primary_type_name FROM primary_type INNER JOIN primary_preferences ON primary_type.primary_type_id = primary_preferences.primary_type_id WHERE user_id = ?');
$query->execute(array($id));
while ($result2 = $query->fetch()) {
    array_push($preferences, $result2['primary_type_name']);
}
$query = $database->prepare('SELECT secondary_type_name FROM secondary_type INNER JOIN secondary_preferences ON secondary_type.secondary_type_id = secondary_preferences.secondary_type_id WHERE user_id = ?');
$query->execute(array($id));
while ($result2 = $query->fetch()) {
    array_push($preferences, $result2['secondary_type_name']);
}

$generatedJourney = array();
$query = $database->prepare('SELECT journey_id, journey_title FROM journey WHERE user_id = ?');
$query->execute(array($id));
while ($result2 = $query->fetch()) {
    array_push($generatedJourney, $result2['journey_name']);
}



// Create the file
$myfile = fopen("data.txt", "w") or die("Unable to open file!");
$txt = "Firstname: ".$result['firstname']."\n";
fwrite($myfile, $txt);
$txt = "Lastname: ".$result['lastname']."\n";
fwrite($myfile, $txt);
$txt = "Email: ".$result['email']."\n";
fwrite($myfile, $txt);
$txt = "Password: ".$result['password']."\n";
fwrite($myfile, $txt);
$txt = "Preferences: ".implode(", ", $preferences)."\n";
fwrite($myfile, $txt);
$txt = "Generated journeys: ".implode(", ", $generatedJourney)."\n";
fwrite($myfile, $txt);
fclose($myfile);

// Download the file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename("data.txt"));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize("data.txt"));
readfile("data.txt");
exit;

