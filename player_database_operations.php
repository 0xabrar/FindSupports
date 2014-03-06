<?php 

include_once('player.php');

class PlayerDatabaseOperations {

	private $localhost = "localhost";
	private $user = "root";
	private $password = "candy12";
	private $db = "summoners";
	private $con;

	/* TABLE format is PID, name, games_played, games_won, win_percent, 
  		avg_assists, most_played_support, lolking, date 
  		Add information into the table. */

	function __construct() {
		$this->con = mysqli_connect("localhost", "root", "candy12", "summoners");
		// Check connection
		if (mysqli_connect_errno()) {
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
	}

	private function add_player(&$player) {
		echo "wtf man";
		$sql = "INSERT INTO support (PID, name, games_played, games_won, 
			win_percent, avg_assists, most_played_support, lolking, mmr, date_added) 
			VALUES ('$player->id', '$player->name', '$player->games_played', '$player->games_won',
				'$player->win_percent', '$player->avg_assists', '$player->most_played_support',
				'$player->lolking_profile', '$player->mmr', NOW())";

		if (!mysqli_query($this->con,$sql)) {
			die('Error: ' . mysqli_error($this->con));
		}

		echo "1 summoner added." . "<br>";
		mysqli_close($this->con); //TODO: separate function to close
	}
}

?>