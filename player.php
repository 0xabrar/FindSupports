<?php

//Wrapper file for API calls.
include('php-riot-api.php');


class Player {
	/*
	Class associated with a single summoner on League of Legengds. The Player
	has all of the data members associated with the displayed talbes as 
	private instance varaibles. This interacts with the separate DatabasePlayer class
	and the calling PHP page to set and return Player information.  
	*/
	
	private $api;
	private $name = "";
	private $id = "";
	private $games_played;
	private $games_won;
	private $win_percent = 0;
	private $total_assists = 0;
	private $most_played_champion = "";
	private $lolking_profile = "";

	/* TODO: implement this functionality in
	#Apparently used to keep track of important champion statistics.
	stats_to_track = ['TOTAL_SESSIONS_PLAYED', 'TOTAL_SESSIONS_WON', 'TOTAL_ASSISTS', 'TOTAL_CHAMPION_KILLS', 'TOTAL_DEATHS_PER_SESSION']
	#TODO: decide on support champions
	names_to_track = ['Sona', 'Soraka', 'Janna', 'Taric', 'Elise', 'Annie', 'Fiddlesticks', 'Leona', 'Thresh', 'Zyra', 'Blitzcrank', 'Nami' ] 
	*/


	/* TODO: would prefer to be able to use a Map like this, refactor
	private function get_summoner_info($which_info) {

		// Returns relevant summoner information based on 
		//$which_info as a PHP array.
		$data = array (
			"summoner" => $this->api->getSummonerByName($this->name), 
			"stats" => $this->api->getStats($this->id,'ranked'),
			"league" => $this->api->getLeague($this->id) ,
		);
		
		$summoner_info_json = $data[$which_info];
		$summoner_info = json_decode($summoner_info_json, true);
		return summoner_info;
	} */


	private function get_summoner_tier($summoner_tier) {
		/* Return a points associated with the specific tier of the player. */
		$tier = array(
    		"CHALLENGER" => 500,
    		"DIAMOND" => 400,
    		"PLATINUM"  => 300,
    		"GOLD" => 200,
    		"SILVER" => 100 ,
    		"BRONZE" => 0 
		);
		return $tier[$summoner_tier];
	}

	private function get_summoner_division($summoner_division) {
		/* Return a points associated with the specific division of the player.*/
		$tier = array(
			"I" => 100 ,
			"II" => 80 ,
			"III" => 60 ,
			"IV" => 40 ,
			"V" => 20
		);
		return $tier[$summoner_division]; 
	}


	function __construct($summoner_name, $region) {
		$this->api = new riotapi($region);
		$this->name = $summoner_name;

		//TODO: interact with database_player to see if player exists already.
		$this->set_id();
		echo $this->id;	
		echo "<br><br>";
		$this->set_stats();

		
	}

	private function set_id() {
		//Set the ID of the summoner to the one determined from making an API 
		//call based on summoner name. 
		$summoner_api = $this->api->getSummonerByName($this->name);
		$summoner = json_decode($summoner_api, true);
		$this->id = $summoner["id"];
	}

	private function set_stats() {
		$summoner_api = $this->api->getStats($this->id, "ranked");
		$summoner_stats = json_decode($summoner_api, true);
		$summoner_stats = $summoner_stats["champions"];

		//Go through the stats related solely to champions and extract
		//needed information from them.
		foreach($summoner_stats as $champion ) {
			print_r($champion);
			$champion_name = $champion["name"];
			print_r($champion_name);
			echo "<br><br>";
		}
	}



	//Includes all of the getter functions for table data associated 
	//with a specific player.
	public function get_name() {
		return $this->name;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_games_played() {
		return $this->games_played;
	}

	public function get_games_won() {
		return $this->games_won;
	}

	public function get_win_percent() {
		return $this->win_percent;
	}

	public function get_total_assists() {
		return $this->total_assists;
	}

	public function get_most_played_champion() {
		return $this->most_played_champion;
	}

	public function get_lolking() {
		return $this->lolking_profile;
	}
}

?>