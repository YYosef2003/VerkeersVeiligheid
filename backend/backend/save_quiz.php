<?php
header("Content-Type: application/json");
require_once "db.php";

$user_id = $_POST["user_id"] ?? null;
$question = $_POST["question"] ?? "";
$given_answer = $_POST["given_answer"] ?? "";
$correct_answer = $_POST["correct_answer"] ?? "";
$is_correct = $_POST["is_correct"] ?? 0;
$score = $_POST["score"] ?? 0;

if (!$user_id || $question === "" || $given_answer === "") {
    echo json_encode(["success" => false, "message" => "Data ontbreekt"]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO quiz_results 
    (user_id, question, given_answer, correct_answer, is_correct, score)
    VALUES (:user_id, :question, :given_answer, :correct_answer, :is_correct, :score)
");

$stmt->execute([
    ":user_id" => $user_id,
    ":question" => $question,
    ":given_answer" => $given_answer,
    ":correct_answer" => $correct_answer,
    ":is_correct" => $is_correct,
    ":score" => $score
]);

echo json_encode(["success" => true]);
?>