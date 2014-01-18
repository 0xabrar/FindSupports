<?php 
	$summoner_name = $_GET["summoner"];
	$processed = exec("python call_summoner_info.py .$summoner_name");
	echo $processed;
?>