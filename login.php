<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login | Verkeersgame</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .auth-box {
            max-width: 420px;
            margin: 80px auto;
            background: white;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .auth-box h2 { margin-bottom: 20px; }

        .auth-box input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 15px;
        }

        .auth-box button {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            border: none;
            border-radius: 25px;
            background: #111;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        .auth-box button:hover {
            transform: scale(1.03);
            background: #000;
        }

        .auth-link { margin-top: 15px; display: block; }

        .auth-link a {
            color: #00b3ff;
            text-decoration: none;
        }

        #msg { margin-top: 10px; color: red; }
    </style>
</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-box">
    <h2>👤 Inloggen</h2>

    <input type="text" id="username" placeholder="Gebruikersnaam">
    <input type="password" id="password" placeholder="Wachtwoord">

    <button type="button" onclick="login()">Login</button>

    <p id="msg"></p>

    <div class="auth-link">
        Nog geen account? <a href="register.php">Registreer</a>
    </div>
</div>

<script src="js/login.js"></script>
<script src="js/navbar.js"></script>

</body>
</html>

