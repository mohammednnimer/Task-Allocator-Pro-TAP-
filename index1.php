
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=teamSport', 'alnari', 'pai@2024');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

$club = isset($_GET['club']) ? $_GET['club'] : '';

$sql = "SELECT name, score1stMatch, score2ndMatch, score3rdMatch FROM players WHERE club = :club";
$stmt = $pdo->prepare($sql);
$stmt->execute(['club' => $club]);

$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($players)
{
    $totalScores = 0;

    echo "<h1>Scores for $club's Club Players</h1>";
    echo "<table border='1'>
            <tr>
                <th>Player Name</th>
                <th>Player Total Scores</th>
            </tr>";
    
    foreach ($players as $player) {
        $totalScore = $player['score1stMatch'] + $player['score2ndMatch'] + $player['score3rdMatch'];
        $totalScores += $totalScore;
        echo "<tr>
                <td>" . $player['name'] . "</td>
                <td>" . $totalScore . "</td>
              </tr>";
    }
    
    echo "</table>";
    echo "<p>Total Scores ($totalScores)</p>";
}else{
    echo "<h1> No Scores for $club's Club Players</h1>";
   
}

?>
