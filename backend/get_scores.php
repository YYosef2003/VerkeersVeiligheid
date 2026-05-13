<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "crossyroad");

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "
    SELECT player_name, MAX(score) AS score
    FROM highscores
    GROUP BY player_name
    ORDER BY score DESC
    LIMIT 10
";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([]);
    exit;
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>