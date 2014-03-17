#Run on initial setup only

CREATE DATABASE summoners;
USE summoners;

#Create the initial table under supports database.
CREATE TABLE support (
	PID INT(32) NOT NULL,
	name VARCHAR(20),
	region VARCHAR(20), 
	games_played VARCHAR(5),
	games_won VARCHAR(5),
	win_percent VARCHAR(4),
	avg_assists VARCHAR(4), 
	most_played_support VARCHAR(20),
	lolking VARCHAR(64),
	mmr VARCHAR(4),
	date_added INT(32),
	PRIMARY KEY (PID));

#Show table.
DESCRIBE support;
