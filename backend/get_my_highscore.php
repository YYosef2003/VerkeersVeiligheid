<?php
header("Content-Type: application/json");
require_once "db.php";

$user_id = $_GET["user_id"] ?? null;
$allowedGames = ["obstacle", "reaction", "hazard", "signs", "priority"];
$game_name = $_GET["game_name"] ?? "obstacle";

if (!$user_id) {
    echo json_encode([]);
    exit;
}

if (!in_array($game_name, $allowedGames)) {
    $game_name = "obstacle";
}

try {
    $stmt = $conn->prepare("
        SELECT player_name, score, game_name, created_at
        FROM highscores
        WHERE user_id = :user_id
        AND game_name = :game_name
        ORDER BY score DESC
        LIMIT 1
    ");

    $stmt->execute([
        ":user_id" => $user_id,
        ":game_name" => $game_name
    ]);

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode([]);
}
?>
