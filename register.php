<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<main class="content">

    <div class="game-container">

        <h2>Maak een account</h2>

        <form>

           <input id="username" type="text" placeholder="Gebruikersnaam" required
                style="width:100%; padding:12px; margin:10px 0; border-radius:15px; border:1px solid #ccc;">

            <input id="email" type="email" placeholder="E-mail" required
                style="width:100%; padding:12px; margin:10px 0; border-radius:15px; border:1px solid #ccc;">

            <input id="password" type="password" placeholder="Wachtwoord" required
                style="width:100%; padding:12px; margin:10px 0; border-radius:15px; border:1px solid #ccc;">

            <button class="button" type="button" onclick="register()" style="width:100%;">
             Account aanmaken
            </button>

        </form>

        <p style="margin-top:15px;">
            Al een account?
            <a href="login.php">Login hier</a>
        </p>

    </div>

</main>

<script>
function register() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('backend/session_handler.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'register',
            username: username,
            email: email,
            password: password
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            localStorage.removeItem('user');
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 500);
        } else {
            alert(data.message || 'Registratie mislukt');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Kan geen verbinding maken met server');
    });
}
</script>

</body>
</html>