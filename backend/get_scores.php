<?php
header("Content-Type: application/json");
require_once "db.php";

$allowedGames = ["obstacle", "reaction", "hazard", "signs", "priority"];
$game_name = $_GET["game_name"] ?? "obstacle";

if (!in_array($game_name, $allowedGames)) {
    $game_name = "obstacle";
}

try {
    $stmt = $conn->prepare("
        SELECT player_name, MAX(score) AS score
        FROM highscores
        WHERE game_name = :game_name
        GROUP BY player_name
        ORDER BY score DESC
        LIMIT 10
    ");

    $stmt->execute([":game_name" => $game_name]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode([]);
}
?>
