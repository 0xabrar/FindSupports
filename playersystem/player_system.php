<?php

include('player_database_operations.php');
include_once('player.php');

class PlayerSystem {
	/** This is the player system set around one single summoner.
	The one summoner is tracked, as well as other summoners near the summoner's
	MMR. The class is responsible for reading and writing to the database, as well
	as maintaining the overall player relations system. */
	
	private $current_player;
	private $other_players = array();
	//Array containing all of the information of other players related to current player.
	private $other_players_data;


	//An instance of a PlayerDatabaseOperations.
	private $player_database_operations;
	
	function __construct($summoner_name, $region) {
		/** Constructor for a PlayerSystem. This takes the original summoner for which
		the PlayerSystem is instantiated and uses it as the central point. Other summoners
		with similar mmrs to the main player will be found in the database and have instances
		of them created to display on results tables. */
		$this->player_database_operations = new PlayerDatabaseOperations();
		$this->current_player = new Player($summoner_name, $region);

		$this->operate_player($this->current_player);
		
		//Retrieve listing of all other plays near the current player's mmr. 
		$this->other_players_data = $this->player_database_operations->get_other_players($this->current_player);
		$this->sort_other_players();
		
		//TODO: print error when user is not playing ranked
		$this->player_database_operations->close_db();
	}

	public function get_player($which_player) {
		/** Return the a new Player instance specified from other summoners. 
		Pre: $which_player is an integer from 0-9, inclusive. */
		return $this->other_players[$which_player];
	}

	private function sort_other_players() {
		/** Goes through the other players and sorts them 
		according to win rate and games won. Make the top 10 support summoners
		the other_players in the PlayerSystem. */
		$all_players = array();

		//Create an array of Players from all other summoner data.
		for ($i = 0; $i < sizeof($this->other_players_data); $i++) {
			$summoner_name = $this->other_players_data[$i]['name'];
			$region = $this->other_players_data[$i]['region'];
			$player = new Player($summoner_name, $region, false);
			//Operate on each individual player.
			//$this->operate_player($player); TODO: this doesn't work do to rate limits
			$player->set_all_information($this->other_players_data[$i]);
			array_push($all_players, $player);
		}

		//Sort the player into best supports.
		usort($all_players, function($a, $b) {
    		return $this->calculate_support_score($b) - $this->calculate_support_score($a);
		});
		for ($i = 0; $i < min(10,sizeof($all_players)); $i++)
			$this->other_players[$i] = $all_players[$i];

	}

	private function calculate_support_score(&$player) {
		/** Take a player and calculate their score based on 
		win rate as well as games won. f(x): winpercent*gamesplayed 
		Post: return a number based on f(x) */

		$win_percent = $player->get_win_percent();
		$games_played = $player->get_games_won();
		return $win_percent * $games_played;
	}

	private function operate_player(&$player) {
		/** Take a player, and operate based on whether: 
			a - the player exists, added recently
				Get player data from database. 

			b - the player does not exist
				Make appropriate api calls to update player, update database. 

			c - the player exists, but must be updated
				Make appropriate api calls to updateplayer, update database. 

			The operations themselves are not kept within this function. */

		//Player already exists in the database.
		if ($this->player_database_operations->contains_ID($player->get_id())) {
			//Player needs to be updated, only need PID to check.
			if ($this->player_database_operations->player_needs_update($player->get_id())) {
				$player->api_construct($player->get_name(), $player->get_region());
				if ($this->player_valid($player)) {
					$this->player_database_operations->update_player($player);
				}
				
			} else {
				$this->update_player_instance($player);
			} 
		//TODO: throw error messages to user when player is not valid
		} else {
			$player->api_construct($player->get_name(), $player->get_region());
			if ($this->player_valid($player)) {
				$this->player_database_operations->add_player($player);
			}
			
		}
    }
	
	private function update_player_instance(&$player) {
		/** Take a player as a parameter, and retrieve all of the information 
		about the player from the database. The Player instance is updated. This is only 
		called in the case that a - the player exists, added recently */

		//Info is an associated array. 
		$info = $this->player_database_operations->get_player_information($player->get_id());
		$player->set_all_information($info);
	}

	private function player_valid($player) {
		/** A predicate function which returns 
		true if and only if all the information for a Player instance is valid. */
		if ($this->current_player->get_name() == "") return false;
		if ($this->current_player->get_id() == "") return false;
		if ($this->current_player->get_region() == "") return false;
		if ($this->current_player->get_games_played() == "") return false;
		if ($this->current_player->get_games_won() == "") return false;
		if ($this->current_player->get_win_percent() == "") return false;
		if ($this->current_player->get_avg_assists() == "") return false;
		if ($this->current_player->get_most_played_support() == "") return false;
		if ($this->current_player->get_lolking() == "") return false;
		if ($this->current_player->get_mmr() == "") return false;
		return true;
	}


	
}

?>