<?php
$conn = new mysqli("localhost", "root", "", "verkeersgame");

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password)
VALUES ('$username', '$email', '$password')";

echo $conn->query($sql) ? json_encode(["status"=>"ok"]) : json_encode(["status"=>"error"]);
?>