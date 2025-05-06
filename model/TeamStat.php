<?php
class TeamStat
{
    private $table = "teamStat";
    private $connexion = null;

    public $teamID;
    public $goals;
    public $shots;
    public $shotsOnTarget;
    public $corners;
    public $result;
    public $xGoals;
    public $date;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function getMatchesByTeamID($teamID)
    {
        $sql = "SELECT gameID, date, goals, xGoals, shots, shotsOnTarget, result
                FROM $this->table
                WHERE teamID = :teamID
                ORDER BY date";
        $query = $this->connexion->prepare($sql);
        $query->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    // getGlobalStatsByTeamID
    public function getGlobalStatsByTeamID($teamID)
    {
        $sql = "SELECT 
                    ROUND(AVG(goals),2) AS avgGoals,
                    ROUND(AVG(xGoals),2) AS avgXGoals,
                    ROUND(AVG(shots),2) AS avgShots,
                    ROUND(AVG(fouls),2) AS avgFouls,
                    COUNT(*) AS totalGames
                FROM teamStat
                WHERE teamID = :teamID;";
        $query = $this->connexion->prepare($sql);
        $query->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getAvgGoalsPerSeason($teamID)
    {
        $sql = "SELECT season, 
                       ROUND(AVG(goals), 2) AS avg_goals, 
                       ROUND(AVG(xGoals), 2) AS avg_xGoals
                FROM teamStat
                WHERE teamID = :teamID
                GROUP BY season
                ORDER BY season";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getResultsPerSeason($teamID)
    {
        $sql = "SELECT season, 
                       COUNT(*) AS total_matches, 
                       SUM(result = 'W') AS wins, 
                       SUM(result = 'L') AS losses, 
                       SUM(result = 'D') AS draws
                FROM teamStat
                WHERE teamID = :teamID
                GROUP BY season
                ORDER BY season";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getStatsByTeam($teamID)
    {
        $sql = "SELECT * FROM $this->table WHERE teamID = $teamID";
        $query = $this->connexion->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getShotsStatsPerSeason($teamID)
    {
        $sql = "SELECT season,
                       ROUND(AVG(shots), 2) AS avg_shots,
                       ROUND(AVG(shotsOnTarget), 2) AS avg_shots_on_target
                FROM teamStat
                WHERE teamID = :teamID
                GROUP BY season
                ORDER BY season";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getYellowCardsPerSeason($teamID)
    {
        $query = "
            SELECT 
                season, 
                SUM(yellowCards) AS yellow_cards
            FROM teamStat
            WHERE teamID = :teamID
            GROUP BY season
            ORDER BY season ASC
        ";

        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRedCardsPerSeason($teamID)
    {
        $query = "
            SELECT 
                season, 
                SUM(redCards) AS red_cards
            FROM teamStat
            WHERE teamID = :teamID
            GROUP BY season
            ORDER BY season ASC
        ";

        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCornersPerSeason($teamID)
    {
        $query = "
            SELECT 
                season, 
                SUM(corners) AS total_corners
            FROM teamStat
            WHERE teamID = :teamID
            GROUP BY season
            ORDER BY season ASC
        ";

        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatchesBySeason($teamID, $season)
    {
        $query = "SELECT 
                    ts.*,
                        g.date,
                        t2.name AS opponent
                    FROM teamStat ts
                    JOIN game g ON ts.gameID = g.gameID
                    JOIN teamStat ts2 ON g.gameID = ts2.gameID AND ts2.teamID != ts.teamID
                    JOIN team t2 ON ts2.teamID = t2.teamID
                    WHERE ts.teamID = :teamID
                    AND ts.season = :season
                    ORDER BY g.date ASC
        ";

        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':teamID', $teamID, PDO::PARAM_INT);
        $stmt->bindParam(':season', $season, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
