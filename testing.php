<!DOCTYPE html>
<html>
<head>
    <title>Find Me A Support League of Legends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- Bootstrap -->  
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php
	
	function get_most_played_champion($champions) {
		// Returns the player's most played champion out of champions played.
		$most_played = "";
		$max_played = 0;
		for ($x = 0; $x < count($champions); $x++) {
			$current_champion = $champions[$x];
			//TODO: add in conditional to make this work
		}
	}

	function get_tier($player_tier) {
		$league = array(
    	"CHALLENGER" => 500,
    	"DIAMOND" => 400,
    	"PLATINUM"  => 300,
    	"GOLD" => 200,
    	"SILVER" => 100 ,
    	"BRONZE" => 0 
	);
		return $league[$player_tier];
	}

	function get_division($player_division) {
		$tier = array(
		"I" => 100 ,
		"II" => 80 ,
		"III" => 60 ,
		"IV" => 40 ,
		"V" => 20
		);
		return $tier[$player_division]; 
	}

	/* 
	summoner_api	: alterered throughout to get different information from the Riot API

	player_summoner_name 	: String of summoner name of player making PHP request
	player_summoner	: summoner information of the player making PHP request
	player_summoner_id 	: String of summoner id of player making PHP request

	*/

	//TODO: make different regions function for api calls
	include('php-riot-api.php');
	$api = new riotapi('na');


	$player_summoner_name = $_GET["summoner"];
	//api call and json decoding must be kept separate
	$summoner_api = $api->getSummonerByName($player_summoner_name);
	$player_summoner = json_decode($summoner_api, true);
	$player_summoner_id = $player_summoner["id"];

	//TODO: divide players into leagues and tiers
	$summoner_api = $api->getStats($player_summoner_id, 'ranked');
	$summoner_stats = json_decode($summoner_api, true);

	echo $summoner_api;


	echo "<br />\n";
	echo "Summoner ID: " . $summoner_id;
	echo "<br />\n";
	

	
	

	
?>

</body>
</html>