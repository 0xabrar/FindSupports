<?php 


include_once('player_system.php');
include_once('php-riot-api.php');


$seed = 'FuperSresh';
$seed = strtolower($seed);
$region = 'euw';

recurse_players($seed, $region);

function recurse_players($name, $region) {
	$api = new riotapi($region);

	$summoner_api = $api->getSummonerByName($name);
	$summoner = json_decode($summoner_api, true);
	$id = $summoner[$name]['id'];
	$gameStats  = $api->getGame($id);
	$gameStats= json_decode($gameStats, true);
	$gameStats = $gameStats['games'][0]['fellowPlayers'];

	for ($i = 0; $i < count($gameStats); $i++) {
		$new_id = $gameStats[$i]['summonerId'];

		$new_api = $api->getSummoner($new_id);
		$new_api = json_decode($new_api, true);
		$name = $new_api[$new_id]['name'];

		create_system($name, $region);
		
		//Recursion ayaah.
		if ($i == (count($gameStats) - 1)) {
			$name = strtolower($name);
			recurse_players($name, $region);
		}
	}
}

function create_system($name, $region) {
	global $players_added;
	$players_added += 1;
	echo $players_added . "<br>";
	$player = new PlayerSystem($name, $region);
}


?>
