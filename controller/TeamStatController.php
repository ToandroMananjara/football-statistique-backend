<?php

class TeamStatController
{

    private $teamStatModel;
    private $leagueModel;

    public function __construct() {}
    // getMatchesByTeamID
    public function getMatchesByTeamID()
    {
        if (isset($_GET['teamID'])) {

            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $matches = $this->teamStatModel->getMatchesByTeamID($teamID);
            echo json_encode($matches);
        }
    }
    // getGlobalStatsByTeamID
    public function getGlobalStatsByTeamID()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $globalStats = $this->teamStatModel->getGlobalStatsByTeamID($teamID);
            echo json_encode($globalStats);
        }
    }

    public function getAvgGoalsPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $avgGoalPerSeason = $this->teamStatModel->getAvgGoalsPerSeason($teamID);
            echo json_encode($avgGoalPerSeason);
        }
    }

    public function getResultsPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $avgGoalPerSeason = $this->teamStatModel->getResultsPerSeason($teamID);
            echo json_encode($avgGoalPerSeason);
        }
    }

    public function getYellowCardsPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $yellowCardsPerSeason = $this->teamStatModel->getYellowCardsPerSeason($teamID);
            echo json_encode($yellowCardsPerSeason);
        }
    }

    public function getRedCardsPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $redCardsPerSeason = $this->teamStatModel->getRedCardsPerSeason($teamID);
            echo json_encode($redCardsPerSeason);
        }
    }

    public function getCornersPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $cornersPerSeason = $this->teamStatModel->getCornersPerSeason($teamID);
            echo json_encode($cornersPerSeason);
        }
    }

    public function getShotsStatsPerSeason()
    {
        if (isset($_GET['teamID'])) {
            $teamID = $_GET['teamID'];
            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);
            $shotsStatsPerSeason = $this->teamStatModel->getShotsStatsPerSeason($teamID);
            echo json_encode($shotsStatsPerSeason);
        }
    }
    public function getMatchesBySeason()
    {
        if (isset($_GET['teamID']) && isset($_GET['season'])) {
            $teamID = $_GET['teamID'];
            $season = $_GET['season'];

            $data = new Database();
            $conn = $data->getConnexion();
            $this->teamStatModel = new TeamStat($conn);

            $matches = $this->teamStatModel->getMatchesBySeason($teamID, $season);

            echo json_encode($matches);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing teamID or season parameter']);
        }
    }

    public function getStatsByTeam($teamID)
    {
        $stats = $this->teamStatModel->getStatsByTeam($teamID);
        echo json_encode($stats);
    }

    public function getBestTeamPerLeague()
    {

        $data = new Database();
        $conn = $data->getConnexion();
        $this->leagueModel = new League($conn);
        $stats = $this->leagueModel->getBestTeamStat();
        echo json_encode($stats);
    }
}
