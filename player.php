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
	private $region;
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
	//Stored as an array of all champion data for that most played support (extract name with ["name"]) 
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


	function __construct($summoner_name, $region) { 
		/** Default constructor will create a new Player instance,
		and set the name, ID, and region of the summoner. */

		$this->api = new riotapi($region);
		$this->name = $summoner_name;
		$this->set_id();
		$this->region = $region;
	}

	public function  construct_using_id($summoner_id, $region) {
		/** Set the name of a Player instance using the summoner's
		summoner ID. Then, construct the rest of the Player instance 
		using the api_construct function. This is only used for populating the database.*/
		//TODO: delete function after populating database
		//TODO: the remaining higher level code must be refactored to allow this function to work 

		$this->api = new riotapi($region);
		$this->id = $summoner_id;
		$this->region = $region;
		
		$summoner_api = $this->api->getSummoner($this->id);
		$summoner = json_decode($summoner_api, true);	
		$this->name = $summoner['name'];

		$this->api_construct($this->name, $region);

	}


	//TODO: want to be able to Map calls to API better
	public function api_construct($summoner_name, $region) {
		
		$this->lolking_profile = "http://www.lolking.net/summoner/na/" . $this->id;
		//Go through API data to determine the most played champion.
		$this->extract_support_champions();
		$this->set_most_played_support();

		//Set all relevant data for support stats, as well as mmr.
		$this->set_support_stats();
		$this->calculate_mmr();

		$this->print_data();
	}

	private function calculate_mmr() {
		/** Take the tier and league information from the getLeague API call
		and convert it into a points system based  on convert_summoner_tier and 
		convert_summoner_division. */
		$mmr = 0;
		$summoner_api = $this->api->getLeague($this->id);
		$summoner_league = json_decode($summoner_api, true);

		//League information formatted as Array[0] == Array
		$summoner_tier = $summoner_league[0]["tier"];
		$summoner_division = $summoner_league[0]["rank"];

		$mmr += $this->convert_summoner_tier($summoner_tier);
		$mmr += $this->convert_summoner_division($summoner_division);
		$this->mmr = $mmr;
	}

	//TODO: only used for diagnostics, remove after
	private function print_data() {
		echo "Name: " . $this->name . "<br>";
		echo "ID: " . $this->id . "<br>";
		echo "Most played support: " . $this->most_played_support["name"] . "<br>";
		echo "Games played: " . $this->games_played . "<br>";
		echo "Games won: " . $this->games_won . "<br>";
		echo "Win percent: " . $this->win_percent . "<br>";
		echo "Average assists: " . $this->avg_assists . "<br>";
		echo "LoLKing: " . $this->lolking_profile . "<br>";
		echo "MMR: " . $this->mmr . "<br><br>";
	}

	private function set_support_stats() {
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

	//START: getter functions
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

	public function get_avg_assists() {
		return $this->avg_assists;
	}

	public function get_most_played_support() {
		return $this->most_played_support["name"];
	}

	public function get_lolking() {
		return $this->lolking_profile;
	}

	public function get_mmr() {
		return $this->mmr;
	}
	//END: getter functions

	private function convert_summoner_tier($summoner_tier) {
		/** Return points associated with the specific tier of the player. */
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

	private function convert_summoner_division($summoner_division) {
		/** Return points associated with the specific division of the player.*/
		$tier = array(
			"I" => 100 ,
			"II" => 80 ,
			"III" => 60 ,
			"IV" => 40 ,
			"V" => 20
		);
		return $tier[$summoner_division]; 
	}

}
?>