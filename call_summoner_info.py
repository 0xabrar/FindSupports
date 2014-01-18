
from riot import LoLAPI

key = "98082977-3716-47db-b6d8-d4837a6e1200"
api = LoLAPI(key)


"""
Overview
-----------------------
The user will input in their summoner name into the search bar, and requests 
will be made to the League API to get all of the necessary information.

Champion Information is returned in the form:
[u'champion_name', {stats}]. 

Players' rating information is returned in the form:
['name', rating]
"""


class Summoner():

    """ Class representing a summoner."""

    def __init__(self, summoner_name):
        """ Create a new summoner processing class. """
        self.summoner_name = summoner_name

    def get_tier(tier):
        """ Take a string form of a tier and return the corresponding number value for placements. """

        return {
            'CHALLENGER': 500,
            'DIAMOND': 400,
            'PLATINUM': 300,
            'GOLD': 200,
            'SILVER': 100,
            'BRONZE': 0
        }[tier]

    def get_division(division):
        """ Take a string form of a division and return the corresponding number value for placements.
        Special note: Challenger players do not have a tier. """
        return {
            'I': 100,
            'II': 80,
            'III': 60,
            'IV': 40,
            'V': 20
        }[division]

    def get_most_played_champion(champions):
        """ Take a list of lists of the form [champion_data][name, stats], and return
        the name of the most played champion.
        """
        most_played = ""
        max_played = 0
        for x in champions:
            if x[1]['TOTAL_SESSIONS_PLAYED'] > max_played:
                most_played = x[0]
                max_played = x[1]['TOTAL_SESSIONS_PLAYED']

        return most_played


other_summoner_name = "Orokai"

# TODO: replace with form information
summoner_info = api.get_summoner_by_name(self.summoner_name)
summoner_id = summoner_info['id']  # Summoner ID used to reduce API calls.
summoner_stats = api.get_ranked_stats_by_id(summoner_id, 3)


# TODO: Replace with properly function league division/tier comparisons
# Form of [summoner_name, points], with each tier = 100 points and each
# division = 20 points
self_league = []
others_league = []

#self_league_data = api.get_league_data_by_id(summoner_id)

# Tier data represented in the form of a dictionary of LeagueItemDto values.
others_summoner_id = api.get_summoner_by_name(other_summoner_name)
others_league_data = api.get_league_data_by_summoner(other_summoner_name)
others_league_tiers = others_league_data['19629093']['entries'][0]

self_league.append(self.summoner_name)
others_league.append(other_summoner_name)


# Go through data of other players to determine their rating.
others_rating = 0
others_rating += get_tier(others_league_tiers['tier'])
others_rating += get_division(others_league_tiers['rank'])

others_league.append(others_rating)


# Data of champions: List[ChampionStatsDto]
all_champions_info = summoner_stats['champions']


# Stored as [name, {stat data values}]
listed_all_champ_stats = []

# Apparently used to keep track of important champion statistics.
stats_to_track = ['TOTAL_SESSIONS_PLAYED', 'TOTAL_SESSIONS_WON',
                  'TOTAL_ASSISTS', 'TOTAL_CHAMPION_KILLS', 'TOTAL_DEATHS_PER_SESSION']
# TODO: decide on support champions
names_to_track = ['Sona', 'Soraka', 'Janna', 'Taric', 'Elise', 'Annie',
                  'Fiddlesticks', 'Leona', 'Thresh', 'Zyra', 'Blitzcrank', 'Nami']

for x in range(len(all_champions_info)):
    # Used to keep track of all stats for specific champion
    specific_champion = []
    specific_champion_stats = {}

    current_champion = all_champions_info[x]
    champion_id = current_champion['id']

    # Weird issue of the 'combined' name which does not have a name field.
    if champion_id != 0:
        champion_name = current_champion['name']
        if champion_name in names_to_track:
            specific_champion.append(champion_name)

            # Data of specific champion stats: AggregatedStatsDto, which is
            # stored as list of maps
            champion_specific_stats = current_champion['stats']

            for x in champion_specific_stats:
                if (x['name']) in stats_to_track:
                    specific_champion_stats[x['name']] = x['value']

            # All information about one specific champion pushed into list
            # element.
            specific_champion.append(specific_champion_stats)
            listed_all_champ_stats.append(specific_champion)


most_played_champion = get_most_played_champion(listed_all_champ_stats)


''' TODO: Remove below, only exists for diagnostics. '''
for x in listed_all_champ_stats:
    print(x)
print ("Most played champion: " + most_played_champion)
