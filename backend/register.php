    <?php
    header("Content-Type: application/json");

    $conn = new mysqli("localhost", "root", "", "crossyroad");

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Database fout"]);
        exit;
    }

    $username = trim($_POST['username'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";

    if (!$username || !$email || !$password) {
        echo json_encode(["success" => false, "message" => "Vul alles in"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Voer een geldig e-mailadres in"]);
        exit;
    }

    $emailDomain = substr(strrchr($email, "@"), 1);
    if (!$emailDomain || !(checkdnsrr($emailDomain, "MX") || checkdnsrr($emailDomain, "A"))) {
        echo json_encode(["success" => false, "message" => "Dit e-mailadres lijkt niet te bestaan"]);
        exit;
    }

    $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Gebruiker of email bestaat al"]);
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