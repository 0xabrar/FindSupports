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
	private $name;
	private $id;
	private $games_played;
	private $games_won;
	private $win_percent;
	private $avg_assists;
	private $lolking_profile;
	private $mmr = 0;


	//Lists used to determine champions and stats to track when going through stat data.
	private $stats_to_track = array('TOTAL_SESSIONS_PLAYED', 'TOTAL_SESSIONS_WON', 
		'TOTAL_ASSISTS', 'TOTAL_CHAMPION_KILLS', 'TOTAL_DEATHS_PER_SESSION');
	private $names_to_track = array('Sona', 'Soraka', 'Janna', 'Taric', 'Elise', 'Annie', 
		'Fiddlesticks', 'Leona', 'Thresh', 'Zyra', 'Blitzcrank', 'Nami', 'Alistar');

	//List of the data of champions that a Player plays.
	private $support_champions = array();
	//Stored as an array of all champion data for that most played support. 
	private $most_played_support; 

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
		$this->lolking_profile = "http://www.lolking.net/summoner/na/" . $this->id;

		$this->extract_support_champions();
		$this->set_most_played_support();

		$this->set_stats();

		$this->print_data();
	}

	//TODO: only used for diagnostics, remove after
	private function print_data() {
		echo "Name: " . $this->name . "<br>";
		echo "ID: " . $this->id . "<br>";
		echo "Games played: " . $this->games_played . "<br>";
		echo "Games won: " . $this->games_won . "<br>";
		echo "Win percent: " . $this->win_percent . "<br>";
		echo "Average assists: " . $this->avg_assists . "<br>";
		echo "lolking: " . $this->lolking_profile . "<br>";
		echo "MMR: " . $this->mmr . "<br>";
	}

	private function set_stats() {
		print_r($this->most_played_support);
		echo "<br><br>";
		$this->games_played = $this->most_played_support["stats"]["totalSessionsPlayed"];
		$this->games_won = $this->most_played_support["stats"]["totalSessionsWon"];
		$this->avg_assists = $this->most_played_support["stats"]["totalAssists"] / $this->games_played;
		$this->win_percent= $this->games_won / $this->games_played * 100;
	}

	private function set_id() {
		/*Set the ID of the summoner to the one determined from making an API 
		call based on summoner name. */
		$summoner_api = $this->api->getSummonerByName($this->name);
		$summoner = json_decode($summoner_api, true);
		$this->id = $summoner["id"];
	}

	private function extract_support_champions() {
		/** Set the support champion info of the current Player instance. This will extract
		all support champion information and place it into $support_champions. */
		$summoner_api = $this->api->getStats($this->id, "ranked");
		$summoner_stats = json_decode($summoner_api, true);
		$summoner_stats = $summoner_stats["champions"];

		//Go through the stats related solely to champions and extract
		//needed information from them.
		foreach($summoner_stats as $champion ) {
			$champion_name = $champion["name"];
			//Only want to keep track of supports and not regular champions.
			if  (in_array($champion_name, $this->names_to_track)) {
				array_push($this->support_champions, $champion);
			}
		}
	}


	private function set_most_played_support() {
		/** Go through the listing of support champions that the Player plays,
		and then set the most played support as the champion with highest total sessions. */
		$max = 0;
		$most_played_support;
		foreach($this->support_champions as $support) {
			if ($support["stats"]["totalSessionsPlayed"] > $max) {
				$max = $support["stats"]["totalSessionsPlayed"];
				$most_played_support = $support;
			}
		}
		$this->most_played_support = $most_played_support;
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

	public function get_most_played_support() {
		return $this->get_most_played_support;
	}

	public function get_lolking() {
		return $this->lolking_profile;
	}
}

?>