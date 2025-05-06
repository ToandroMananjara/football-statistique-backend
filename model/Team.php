<?php
class Team
{
    private $table = "team";
    private $connexion = null;

    public $teamID;
    public $name;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function getAllTeams()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->connexion->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getAllTeamPerLeague($leagueID)
    {

        $sql = "SELECT 
                    t.teamID ,
                    t.name ,
                    SUM(
                        CASE ts.result
                            WHEN 'W' THEN 3
                            WHEN 'D' THEN 1
                            ELSE 0
                        END
                    ) AS totalPoints
                FROM team t
                JOIN teamStat ts ON t.teamID = ts.teamID
                JOIN game g ON ts.gameID = g.gameID
                WHERE g.leagueID = :leagueID
                GROUP BY t.teamID, t.name
                ORDER BY totalPoints DESC;
                ";
        $query = $this->connexion->prepare($sql);
        $query->bindParam(':leagueID', $leagueID, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
