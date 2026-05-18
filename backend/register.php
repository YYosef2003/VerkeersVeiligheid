    <?php
    header("Content-Type: application/json");

    $conn = new mysqli("localhost", "root", "", "crossyroad");

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Database fout"]);
        exit;
    }

    $username = $_POST['username'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";

    if (!$username || !$email || !$password) {
        echo json_encode(["success" => false, "message" => "Vul alles in"]);
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $username, $email, $hashed);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Opslaan mislukt"]);
    }
    ?>