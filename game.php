<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkeersveiligheid | Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>🎮 Verkeersgames</h1>

    <div class="navbar">

       
        <nav class="nav-left">
            <a href="index.html">Home</a>
            <a href="info.html">Verkeersveiligheid</a>
            <a href="game.html" class="active">Game</a>
            <a href="contact.html">Contact</a>
            <a href="Over-ons.html">Over Ons</a>
            <a href="highscores.html">Highscores</a>
            <a href="results.html">Mijn resultaten</a>
        </nav>

        
        <div class="nav-right">
            <span id="logged-user"></span>
            <a href="login.html" id="login-btn" class="auth-btn">Login</a>
            <button id="logout-btn" class="auth-btn" style="display:none;" onclick="logout()">Uitloggen</button>
        </div>

    </div>
</header>
    

<main class="content">  

    <!-- GAME MENU -->
    <section id="game-select" class="game-selection">

        <div class="game-card" onclick="startGame('quiz')">
            <div class="game-emoji">🚦</div>
            <h3>Verkeersquiz</h3>
            <p>Test je kennis met 35+ verkeersvragen.</p>
        </div>

        <div class="game-card" onclick="startGame('obstacle')">
            <div class="game-emoji">🚗</div>
            <h3>Obstakel game</h3>
            <p>Rijd en ontwijk obstakels zo lang mogelijk.</p>
        </div>

    </section>

    <!-- GAME AREA -->
    <section id="game-area" class="game-container" style="display:none;">

        <h2 id="game-title"></h2>
        <h3 id="level-title"></h3>

        <div id="quiz-game">
            <h3 id="question"></h3>
            <div class="choices"></div>
        </div>

        <!-- FIX: wrapper toegevoegd (nodig voor JS, geen game logica veranderd) -->
        <div id="obstacle-wrapper" style="display:none;">
            <canvas id="obstacle-game" width="500" height="400"></canvas>
        </div>

        <div id="memory-game"></div>

        <p id="feedback"></p>

        <div class="game-stats">
            <p id="score">Score: 0</p> 
        </div>

        <button class="back-btn" onclick="backToMenu()">⬅ Terug naar menu</button>
        <button class="button"   onclick="restartGame()">🔁 Speel opnieuw</button>

    </section>

  <!-- END SCREEN -->
    <section id="end-screen" class="game-container" style="display:none;">

        <h2 id="end-title"></h2>
        <p id="end-score"></p>

        <button class="button" onclick="restartGame()">🔁 Speel opnieuw</button>
        <button class="back-btn" onclick="backToMenu()">🏠 Menu</button>

    </section>
    
    <div id="my-highscores"></div>

</main>

<footer>
    <p>© 2026 Verkeersveiligheid</p>
</footer>

<script src="js/game.js"></script>
<script src="js/highscores.js"></script>

<script>
function logout() {
    localStorage.removeItem("user");
    window.location.href = "login.html";
}
</script>

<script>
const user = JSON.parse(localStorage.getItem("user"));

const loginBtn = document.getElementById("login-btn");
const logoutBtn = document.getElementById("logout-btn");

if (user && user.id) {
    if (loginBtn) loginBtn.style.display = "none";
    if (logoutBtn) logoutBtn.style.display = "inline-block";
} else {
    if (loginBtn) loginBtn.style.display = "inline-block";
    if (logoutBtn) logoutBtn.style.display = "none";
}

function logout() {
    localStorage.removeItem("user");
    window.location.href = "login.html";
}
</script>

</body>
</html>