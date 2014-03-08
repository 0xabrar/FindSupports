<?php

include('player_database_operations.php');
include_once('player.php');

class PlayerSystem {
	/** This is the player system set around one single summoner.
	The one summoner is tracked, as well as other summoners near the summoner's
	MMR. The class is responsible for reading and writing to the database, as well
	as maintaining the overall player relations system. */
	

	private $current_player;
	private $other_summoners;

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

		
		//TODO: remove. only for diagnostic purposes
		$this->current_player->print_data();
		echo "Done.";
		$player_database_operations->close_db();
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
				$player->api_construct();
				$this->player_database_operations->update_player($player);
			} else {
				$this->update_player_instance($player);
			} 
		
		} else {
			$player->api_construct();
			$this->player_database_operations->add_player($player);
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



	
}

?>