<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Highscores per game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<main class="content">
    <h1>🏆 Highscores</h1>
    <p>Klik op een game om de highscores van die game te bekijken.</p>

    <div class="highscore-tabs">
        <button class="hs-tab active" data-game="obstacle">🚗 Obstakel Game</button>
        <button class="hs-tab" data-game="reaction">⚡ Reactie Test</button>
        <button class="hs-tab" data-game="hazard">⚠️ Gevaar Herkennen</button>
        <button class="hs-tab" data-game="signs">🪧 Verkeersborden Raden</button>
        <button class="hs-tab" data-game="priority">🚸 Voorrang Kiezen</button>
    </div>

    <h2 id="current-game-title">🚗 Obstakel Game</h2>

    <section class="score-section">
        <h2>Mijn beste score</h2>
        <div id="my-score" class="score-list"></div>
    </section>

    <section class="score-section">
        <h2>Top 10 leaderboard</h2>
        <div id="leaderboard" class="score-list"></div>
    </section>
</main>

<script src="js/highscores.js?v=2"></script>

</body>
</html>
