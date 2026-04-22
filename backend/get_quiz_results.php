<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "verkeersgame");

if ($conn->connect_error) {
    echo json_encode(["error" => "db_error"]);
    exit;
}

$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(["error" => "no_user"]);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM quiz_results WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>