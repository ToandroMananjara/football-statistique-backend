<?php
class Player
{
    private $table = "player";
    private $connexion = null;

    public $playerID;
    public $name;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function getAllPlayers()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->connexion->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
