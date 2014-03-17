<?php

include_once('playersystem/php-riot-api.php');

$summoner_name = $_REQUEST["summoner"];
$region = $_REQUEST["region"];

$api = new riotapi($region);

echo "fuck me";
//echo "Summoner: " .  $summoner_name . "<br>" . "Region: " .$region;


?>
