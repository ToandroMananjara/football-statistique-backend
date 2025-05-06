<?php

class GameController
{
    private $gameModel;

    public function __construct() {}

    public function getTeamMatchesBySeason()
    {
        if (isset($_GET['teamID']) && isset($_GET['season'])) {
            $teamID = $_GET['teamID'];
            $season = $_GET['season'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->gameModel = new Game($conn);
            $teamMatchesBySeason = $this->gameModel->getTeamMatchesBySeason($teamID, $season);
            echo json_encode($teamMatchesBySeason);
        }
    }
    public function getAllGames()
    {
        $games = $this->gameModel->getAllGames();
        echo json_encode($games);
    }
}
