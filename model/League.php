<?php
class League
{
    private $table = "league";
    private $connexion = null;

    public $leagueID;
    public $name;
    public $country;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function getAllLeagues()
    {
        $query = "
            SELECT l.leagueID, l.name
            FROM $this->table l
            ORDER BY l.name ASC
        ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBestTeamStat()
    {
        $query = "
            SELECT 
                teamID,
                SUM(CASE WHEN result = 'W' THEN 1 ELSE 0 END) AS wins,
                SUM(CASE WHEN result = 'D' THEN 1 ELSE 0 END) AS draws,
                SUM(CASE WHEN result = 'L' THEN 1 ELSE 0 END) AS losses,
                SUM(CASE 
                    WHEN result = 'W' THEN 3 
                    WHEN result = 'D' THEN 1 
                    ELSE 0 
                END) AS total_points
            FROM 
                teamStat
            GROUP BY 
                teamID
            ORDER BY 
                total_points DESC
            LIMIT 1;
        ";

        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
