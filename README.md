# lister tous les leagues dans la page d'acceuil

http://localhost/football/league
[
{
"leagueID": 3,
"name": "Bundesliga"
},
{
"leagueID": 4,
"name": "La Liga"
},
{
"leagueID": 5,
"name": "Ligue 1"
},
{
"leagueID": 1,
"name": "Premier League"
},
{
"leagueID": 2,
"name": "Serie A"
}
]

# Quand on clique sur un league on affiche tous les equipes du championnat

http://localhost/football/teamPerLeague?leagueID=
[
{
"teamID": 83,
"name": "Arsenal"
},
{
"teamID": 71,
"name": "Aston Villa"
},
{
"teamID": 73,
"name": "Bournemouth"
},
{
"teamID": 220,
"name": "Brighton"
},
]

# Apres quand on clique sur un club on affiche dynamiquement tous leurs stats en chart

http://localhost/football/matchesByTeamID?teamID=83
[
{
"gameID": 4755,
"date": "2014-08-16 17:30:00",
"goals": 2,
"xGoals": 1.554110000000000102460262496606446802616119384765625,
"shots": 14,
"shotsOnTarget": 6,
"result": "W"
},
{
"gameID": 4764,
"date": "2014-08-23 17:30:00",
"goals": 2,
"xGoals": 1.4335500000000001019628825815743766725063323974609375,
"shots": 13,
"shotsOnTarget": 3,
"result": "D"
},
{
"gameID": 4778,
"date": "2014-08-31 16:00:00",
"goals": 1,
"xGoals": 2.296489999999999920277105047716759145259857177734375,
"shots": 24,
"shotsOnTarget": 6,
"result": "D"
},
]

http://localhost/football/globalStatsByTeamID?teamID=83
{
"avgGoals": "1.77",
"avgXGoals": 1.6799999999999999378275106209912337362766265869140625,
"avgShots": "13.80",
"avgFouls": "10.09",
"totalGames": 266
}

avgGoalsPerSeason => type: 'line'
http://localhost/football/avgGoalsPerSeason?teamID=83
[
{
"season": 2014,
"avg_goals": "1.87",
"avg_xGoals": 1.8400000000000000799360577730112709105014801025390625
},
{
"season": 2015,
"avg_goals": "1.71",
"avg_xGoals": 1.939999999999999946709294817992486059665679931640625
},
{
"season": 2016,
"avg_goals": "2.03",
"avg_xGoals": 1.6699999999999999289457264239899814128875732421875
},
]

resultsPerSeason => type: 'bar'
http://localhost/football/resultsPerSeason?teamID=83
[
{
"season": 2014,
"total_matches": 38,
"wins": "22",
"losses": "7",
"draws": "9"
},
{
"season": 2015,
"total_matches": 38,
"wins": "20",
"losses": "7",
"draws": "11"
},
]

shotsStatsPerSeason => type: 'radar'
http://localhost/football/shotsStatsPerSeason?teamID=83
[
{
"season": 2014,
"avg_shots": "16.05",
"avg_shots_on_target": "5.97"
},
{
"season": 2015,
"avg_shots": "15.05",
"avg_shots_on_target": "5.55"
},
{
"season": 2016,
"avg_shots": "14.89",
"avg_shots_on_target": "5.29"
},
]

# detail quand on clique sur le pic de averageXGPerSeason en tableau ou en carte comme tu veux

http://localhost/football/teamMatchesBySeason?teamID=83&season=2016
[
{
"gameID": 469,
"date": "2016-08-14 19:00:00",
"goals": 3,
"xGoals": 1.1819699999999999651123516741790808737277984619140625,
"shots": 9,
"shotsOnTarget": 5,
"teamName": "Arsenal"
},
{
"gameID": 469,
"date": "2016-08-14 19:00:00",
"goals": 4,
"xGoals": 1.659100000000000019184653865522705018520355224609375,
"shots": 16,
"shotsOnTarget": 7,
"teamName": "Liverpool"
},
{
"gameID": 478,
"date": "2016-08-20 20:30:00",
"goals": 0,
"xGoals": 0.55369299999999999073452272568829357624053955078125,
"shots": 8,
"shotsOnTarget": 1,
"teamName": "Leicester"
},
]

http://localhost/football/yellowCardsPerSeason?teamID=83
[
{
"season": 2014,
"yellow_cards": "68"
},
{
"season": 2015,
"yellow_cards": "39"
},
{
"season": 2016,
"yellow_cards": "67"
},
{
"season": 2017,
"yellow_cards": "57"
},
{
"season": 2018,
"yellow_cards": "72"
},
{
"season": 2019,
"yellow_cards": "86"
},
{
"season": 2020,
"yellow_cards": "47"
}
]

http://localhost/football/redCardsPerSeason?teamID=83
[
{
"season": 2014,
"red_cards": "2"
},
{
"season": 2015,
"red_cards": "4"
},
{
"season": 2016,
"red_cards": "3"
},
{
"season": 2017,
"red_cards": "2"
},
{
"season": 2018,
"red_cards": "2"
},
{
"season": 2019,
"red_cards": "5"
},
{
"season": 2020,
"red_cards": "5"
}
]

http://localhost/football/cornerPerSeason?teamID=83
[
{
"season": 2014,
"total_corners": "254"
},
{
"season": 2015,
"total_corners": "227"
},
{
"season": 2016,
"total_corners": "227"
},
{
"season": 2017,
"total_corners": "225"
},
{
"season": 2018,
"total_corners": "212"
},
{
"season": 2019,
"total_corners": "231"
},
{
"season": 2020,
"total_corners": "208"
}
]
