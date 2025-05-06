<?php

class Router
{
    private $request;
    // private $routes = ["home" => "home", "publication" => "publication", "connexion" => "connexion"];
    private $routes = [
        'league' => ['controller' => 'LeagueController', 'action' => 'getAllLeagues'],
        'teamPerLeague' => ['controller' => 'TeamController', 'action' => 'getAllTeamPerLeague'],
        'matchesByTeamID' => ['controller' => 'TeamStatController', 'action' => 'getMatchesByTeamID'],
        'globalStatsByTeamID' => ['controller' => 'TeamStatController', 'action' => 'getGlobalStatsByTeamID'],
        'avgGoalsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getAvgGoalsPerSeason'],
        'resultsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getResultsPerSeason'],
        'shotsStatsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getShotsStatsPerSeason'],
        'teamMatchesBySeason' => ['controller' => 'GameController', 'action' => 'getTeamMatchesBySeason'],
        'yellowCardsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getYellowCardsPerSeason'],
        'redCardsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getRedCardsPerSeason'],
        'cornerPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getCornersPerSeason'],
        'matchDetailsPerSeason' => ['controller' => 'TeamStatController', 'action' => 'getMatchesBySeason'],
        'bestTeamPerLeague' => ['controller' => 'TeamStatController', 'action' => 'getBestTeamPerLeague'],
    ];
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;

        if (array_key_exists($request, $this->routes)) {
            // Récupérer le contrôleur et l'action correspondant à la route
            $route = $this->routes[$request];  // Utilisation de $this->routes pour accéder aux routes

            // Instanciation du contrôleur
            $controller = new $route['controller']();

            // $controller = new Post();

            // Appel de l'action associée
            $controller->{$route['action']}();
        } else {
            echo "Page not found";
        }
    }
}
