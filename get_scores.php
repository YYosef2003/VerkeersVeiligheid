<?php
header("Content-Type: application/json");
require_once "db.php";

$sql = "
    SELECT h1.player_name, h1.score, h1.created_at
    FROM highscores h1
    INNER JOIN (
        SELECT player_name, MAX(score) AS max_score
        FROM highscores
        GROUP BY player_name
    ) h2
    ON h1.player_name = h2.player_name
    AND h1.score = h2.max_score
    ORDER BY h1.score DESC, h1.created_at ASC
    LIMIT 10
";

$stmt = $conn->query($sql);
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($scores);
?>