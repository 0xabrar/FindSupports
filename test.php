<?php
include('playersystem/player_system.php');

$playersystem = new PlayerSystem("iCharliei", "na");


for ($i = 0; $i < 10; $i++) {
	$player = $playersystem->get_player($i);
}



?>
