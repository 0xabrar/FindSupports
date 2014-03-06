#Run on initial setup only

CREATE DATABASE summoners;
USE summoners;

#Create the initial table under supports database.
CREATE TABLE support (
	PID INT NOT NULL,
	name VARCHAR(20),
	games_played VARCHAR(20),
	games_won VARCHAR(20),
	win_percent VARCHAR(4),
	avg_assists VARCHAR(20), 
	most_played_support VARCHAR(20),
	lolking VARCHAR(64),
	mmr VARCHAR(20),
	date_added DATETIME,
	PRIMARY KEY (PID));

#Show table.
DESCRIBE support;
