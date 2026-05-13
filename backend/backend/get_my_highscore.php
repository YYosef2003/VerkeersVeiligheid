<?php
header("Content-Type: application/json");
require_once "db.php";

$user_id = $_GET["user_id"] ?? null;

if (!$user_id) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT player_name, score, created_at
    FROM highscores
    WHERE user_id = :user_id
    ORDER BY score DESC
    LIMIT 10
");

$stmt->execute([":user_id" => $user_id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>