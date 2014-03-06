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

		$player = new Player($summoner_name, $region);
		$player_database_operations = new PlayerDatabaseOperations();
		echo "itworksherewhynotafter <br>";
		$player_database_operations->add_player($player);
		echo "workpleaseIPraytoYaweh";
	}
}

?>