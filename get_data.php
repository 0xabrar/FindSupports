<?php
include('php-riot-api.php');
//testing classes
$summoner_name = $_POST["summoner"];
$summoner_id = 585897;

$api = new riotapi('na');
$r = $api->getSummonerByName($summoner_name);
$summoner_id = $r['id'];

//$r = $test->getSummoner($summoner_id);
//$r = $test->getSummoner($summoner_id,'masteries');
//$r = $test->getSummoner($summoner_id,'runes');
//$r = $test->getSummoner($summoner_id,'name');
//$r = $test->getStats($summoner_id);
//$r = $test->getStats($summoner_id,'ranked');
//$r = $test->getTeam($summoner_id);
//$r = $test->getLeague($summoner_id);
//$r = $test->getGame($summoner_id);
//$r = $api->getChampion();

echo $r;

