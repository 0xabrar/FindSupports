<?php
/** This file is used to determine if there is an error 
with the summoner given in the search bar by the user. */

include_once('playersystem/php-riot-api.php');

//Get information from request.
$summoner_name = $_REQUEST["summoner"];
$region = $_REQUEST["region"];

//Get summoner stats from League API.
$api = new riotapi($region);
$summoner_api = $api->getSummonerByName($summoner_name);
$summoner = json_decode($summoner_api, true);

//Store relevant information: ID, name, level. 
$summoner_api_name = $summoner['name'];
$id = $summoner['id'];
$level = $summoner['summonerLevel'];


//Check for valid input and send back relevant errors.
//The name entered cannot be empty.
try {
	if ($summoner_name == "") {
		throw new Exception("empty_name");
	} 
}catch (Exception $e) {
	echo json_encode(array('error' => $e->getMessage()));
	return;
}

//Summoner must exist on League of Legends.
try {
	if ($summoner_api_name == "" or $id == "") {
		throw new Exception('no_summoner');
	}
} catch (Exception $e) {
	echo json_encode(array('error' => $e->getMessage()));
	return;
}

//Player must be level 30.
try {
	if ($level != '30') {
		throw new Exception("under30");
	} 
}catch (Exception $e) {
	echo json_encode(array('error' => $e->getMessage()));
	return;
}

//Champion is valid.
echo "summoner=" . $summoner_name . "&region=" . $region;

?>
