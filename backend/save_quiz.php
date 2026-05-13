<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "crossyroad");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database fout"]);
    exit;
}

$user_id = $_POST['user_id'] ?? null;
$question = $_POST['question'] ?? '';
$given_answer = $_POST['given_answer'] ?? '';
$correct_answer = $_POST['correct_answer'] ?? '';
$is_correct = $_POST['is_correct'] ?? 0;
$score = $_POST['score'] ?? 0;

if (!$user_id) {
    echo json_encode(["success" => false, "message" => "Geen user"]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO quiz_results 
    (user_id, question, given_answer, correct_answer, is_correct, score)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "isssii",
    $user_id,
    $question,
    $given_answer,
    $correct_answer,
    $is_correct,
    $score
);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}
?>