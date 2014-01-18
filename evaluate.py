
from riot import LoLAPI

key = "98082977-3716-47db-b6d8-d4837a6e1200"
api = LoLAPI(key)


"""
TODO: Write something legitimate here 

- Retrieve summoner info by name, extract ID  
- ID used to ranked status. Necessary info includes:
	- totalSessionsPlayed
	- totalSessionsLost
	- champions[]

"""

#TODO: replace with form and database information
self_summoner_name = "Distrastic"
other_summoner_name = "Orokai"

#TODO: replace with form information
summoner_info = api.get_summoner_by_name(self_summoner_name)
summoner_id = summoner_info['id'] #Summoner ID used to reduce API calls.
summoner_stats = api.get_ranked_stats_by_id(summoner_id, 3)

"""
#TODO: Replace with properly function league division/tier comparisons
#Form of [summoner_name, points], with each tier = 100 points and each division = 20 points
self_league = []
others_league = []

#self_league_data = api.get_league_data_by_id(summoner_id)
others_league_data = api.get_league_data_by_summoner(other_summoner_name)

self_league.append(self_summoner_name)
others_league.append(other_summoner_name)

print(others_league_data)


others_league.append(others_league_data[u'rank'])
others_league.append(others_league_data[u'tier'])

for x in self_league:
	print (x)

"""

#Data of champions: List[ChampionStatsDto]
all_champions_info = summoner_stats['champions']

#TODO: Make sure that key u'name' is valid because of random non-champion info.
print("eqoudtkj25gn[r THIS INDEX: " + str(all_champions_info[23]))
print


#Stored as [name, {stat data values}] 
listed_all_champ_stats = []

#Apparently used to keep track of important champion statistics.
stats_to_track = ['TOTAL_SESSIONS_PLAYED', 'TOTAL_SESSIONS_WON', 'TOTAL_ASSISTS', 'TOTAL_CHAMPION_KILLS', 'TOTAL_DEATHS_PER_SESSION']
#TODO: decide on support champions
names_to_track = ['Sona', 'Soraka', 'Janna', 'Taric', 'Elise', 'Annie', 'Fiddlesticks', 'Leona', 'Thresh', 'Zyra', 'Blitzcrank', 'Nami' ] 

for x in range(len(all_champions_info)):
	if x != 23:

		#Used to keep track of all stats for specific champion
		specific_champion = [] 
		specific_champion_stats = {}

		current_champion  = all_champions_info[x]
		champion_name = current_champion['name']

		if champion_name in names_to_track:
			specific_champion.append(champion_name)

			#Data of specific champion stats: AggregatedStatsDto, which is stored as list of maps
			champion_specific_stats = current_champion['stats']

			for x in champion_specific_stats:
				if (x['name']) in stats_to_track:
					specific_champion_stats[x['name']] = x['value']

			#All information about one specific champion pushed into list element. 
			specific_champion.append(specific_champion_stats)
			listed_all_champ_stats.append(specific_champion)


for x in listed_all_champ_stats:
	print(x)


