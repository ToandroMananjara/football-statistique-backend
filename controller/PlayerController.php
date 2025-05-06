<?php

class PlayerController
{
    private $playerModel;

    public function __construct() {}

    public function getAllPlayers()
    {
        $players = $this->playerModel->getAllPlayers();
        echo json_encode($players);
    }
}
