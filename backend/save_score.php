<?php
header("Content-Type: application/json");
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data["user_id"] ?? null;
$player_name = $data["player_name"] ?? "";
$score = $data["score"] ?? null;

if (!$user_id || $player_name === "" || $score === null) {
    echo json_encode(["success" => false, "message" => "Data ontbreekt"]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO highscores (user_id, player_name, score)
    VALUES (:user_id, :player_name, :score)
");

$stmt->execute([
    ":user_id" => $user_id,
    ":player_name" => $player_name,
    ":score" => (int)$score
]);

echo json_encode(["success" => true]);
?>