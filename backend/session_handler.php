<?php
header("Content-Type: application/json");
session_start();

require_once(__DIR__ . "/db.php");

$action = $_POST["action"] ?? "";

if ($action === "login") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    try {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(["success" => false, "message" => "Gebruiker niet gevonden"]);
            exit;
        }

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            echo json_encode([
                "success" => true,
                "id" => $user["id"],
                "username" => $user["username"]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Wachtwoord klopt niet"]);
        }

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database fout: " . $e->getMessage()]);
    }

} elseif ($action === "logout") {
    session_destroy();
    echo json_encode(["success" => true, "message" => "Uitgelogd"]);

} elseif ($action === "register") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Alle velden zijn verplicht"]);
        exit;
    }

    // Controleert of het e-mailadres een geldig formaat heeft, bijvoorbeeld naam@gmail.com
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Voer een geldig e-mailadres in"]);
        exit;
    }

    // Controleert of het domein van het e-mailadres echt bestaat, bijvoorbeeld gmail.com of outlook.com
    $emailDomain = substr(strrchr($email, "@"), 1);
    if (!$emailDomain || !(checkdnsrr($emailDomain, "MX") || checkdnsrr($emailDomain, "A"))) {
        echo json_encode(["success" => false, "message" => "Dit e-mailadres lijkt niet te bestaan"]);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetch()) {
            echo json_encode(["success" => false, "message" => "Gebruiker of email bestaat al"]);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        echo json_encode(["success" => true, "message" => "Account aangemaakt! Log nu in."]);

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database fout: " . $e->getMessage()]);
    }

} else {
    echo json_encode(["success" => false, "message" => "Onbekende actie"]);
}
?>