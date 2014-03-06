#Run on initial setup only

CREATE DATABASE summoners;
USE supports;

#Create the initial table under supports database.
CREATE TABLE support (name VARCHAR(20), games_played VARCHAR(20),
games_won VARCHAR(20), win_percent VARCHAR(4),
avg_assists VARCHAR(20), most_played_champion VARCHAR(20),
lolking VARCHAR(64), date DATETIME);

#Show table.
DESCRIBE support;
