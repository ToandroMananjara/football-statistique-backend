<?php
class LeagueController
{
    private $leagueModel;

    public function __construct() {}

    public function getAllLeagues()
    {
        $data = new Database();

        $conn = $data->getConnexion();

        $this->leagueModel = new League($conn);
        $leagues = $this->leagueModel->getAllLeagues();
        if ($leagues) {
            echo json_encode($leagues);
        } else {
            echo json_encode(["message" => "No leagues found"]);
        }
    }
}
