<?php
class Game
{
    private $table = "game";
    private $connexion = null;

    public $gameID;
    public $leagueID;
    public $season;
    public $date;
    public $homeTeamID;
    public $awayTeamID;
    public $homeGoals;
    public $awayGoals;
    public $homeProbability;
    public $drawProbability;
    public $awayProbability;
    public $homeGoalsHalfTime;
    public $awayGoalsHalfTime;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }
    public function getTeamMatchesBySeason($teamID, $season)
    {
        $sql = "
                SELECT 
                    g.gameID, 
                    g.date, 
                    ts.goals, 
                    ts.xGoals, 
                    ts.shots, 
                    ts.shotsOnTarget,
                    t.name AS teamName
                FROM teamStat ts
                JOIN game g ON g.gameID = ts.gameID
                JOIN team t ON ts.teamID = t.teamID
                WHERE (g.homeTeamID = ? OR g.awayTeamID = ?) 
                AND ts.season = ?
                ORDER BY g.date ASC
        ";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$teamID, $teamID, $season]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGames()
    {
        $sql = "SELECT * FROM $this->table";
        $query = $this->connexion->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
