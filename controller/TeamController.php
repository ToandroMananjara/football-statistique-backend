<?php

class TeamController
{
    private $teamModel;

    public function __construct() {}

    public function getAllTeamPerLeague()
    {
        $data = new Database();

        $conn = $data->getConnexion();

        if (isset($_GET['leagueID'])) {
            $leagueID = $_GET['leagueID'];
            $this->teamModel = new Team($conn);
            $teams = $this->teamModel->getAllTeamPerLeague($leagueID);
            if ($teams) {
                echo json_encode($teams);
            } else {
                echo json_encode(["message" => "No teams found"]);
            }
        } else {
            echo json_encode(["message" => "League ID is required"]);
            return;
        }
    }
}
