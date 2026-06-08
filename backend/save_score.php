<?php
header("Content-Type: application/json");
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data["user_id"] ?? null;
$player_name = trim($data["player_name"] ?? "");
$score = $data["score"] ?? null;
$game_name = $data["game_name"] ?? "obstacle";

$allowedGames = ["obstacle", "reaction", "hazard", "signs", "priority"];

if (!in_array($game_name, $allowedGames)) {
    $game_name = "obstacle";
}

if (!$user_id || $player_name === "" || $score === null) {
    echo json_encode(["success" => false, "message" => "Data ontbreekt"]);
    exit;
}

try {
    $stmt = $conn->prepare("
        INSERT INTO highscores (user_id, player_name, score, game_name, created_at)
        VALUES (:user_id, :player_name, :score, :game_name, NOW())
    ");

    $stmt->execute([
        ":user_id" => $user_id,
        ":player_name" => $player_name,
        ":score" => (int)$score,
        ":game_name" => $game_name
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Score opgeslagen"
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>
