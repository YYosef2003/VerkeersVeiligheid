<?php
header("Content-Type: application/json");
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["player_name"]) || !isset($data["score"])) {
    echo json_encode([
        "success" => false,
        "message" => "Naam of score ontbreekt."
    ]);
    exit;
}

$player_name = trim($data["player_name"]);
$score = (int)$data["score"];

if ($player_name === "" || strlen($player_name) > 50 || $score < 0) {
    echo json_encode([
        "success" => false,
        "message" => "Ongeldige invoer."
    ]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO highscores (player_name, score)
    VALUES (:player_name, :score)
");

$stmt->execute([
    ":player_name" => $player_name,
    ":score" => $score
]);

echo json_encode([
    "success" => true,
    "message" => "Score opgeslagen."
]);
?>