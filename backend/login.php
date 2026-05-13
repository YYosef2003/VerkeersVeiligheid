<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "crossyroad");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database fout"]);
    exit;
}

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Gebruiker niet gevonden"]);
    exit;
}

$user = $result->fetch_assoc();

if (password_verify($password, $user["password"])) {
    echo json_encode([
        "success" => true,
        "id" => $user["id"],
        "username" => $user["username"]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Wachtwoord klopt niet"]);
}
?>