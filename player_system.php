<?php

include('player_database_operations.php');
include_once('player.php');

class PlayerSystem {
	/** This is the player system set around one single summoner.
	The one summoner is tracked, as well as other summoners near the summoner's
	MMR. The class is responsible for reading and writing to the database, as well
	as maintaining the overall player relations system. */
	

	private $current_summoner;
	private $other_summoners;

	//An instance of a PlayerDatabaseOperations.
	private $player_database_operations;
	
	function __construct($summoner_name, $region) {
		/** Constructor for a PlayerSystem. This takes the original summoner for which
		the PlayerSystem is instantiated, and then does operations based on whether:
			a - the player exists, added recently
			b - the player does not exist
			c - the player exists, but must be updated
		Operations for other players are kept in separate functions. */

		$player_database_operations = new PlayerDatabaseOperations();
		$player = new Player($summoner_name, $region);

		//Player already exists in the database.

		if ($player_database_operations->contains_ID($player->get_id())) {
			//Player needs to be updated, only need PID to check.
			if ($player_database_operations->player_needs_update($player->get_id())) {
				echo "We will update summoner.";
			} else {
				//TODO: make calls to db to retrieve information instead of doing this
				echo "Summoner already exists.";
			} 
	
		} else {
			$player->api_construct();
			$player_database_operations->add_player($player);
		}
		
		$player_database_operations->close_db();
	}
}

?>