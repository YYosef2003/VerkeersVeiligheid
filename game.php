<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkeersveiligheid | Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>
    

<main class="content">  

   
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

 
    <section id="game-area" class="game-container" style="display:none;">

        <h2 id="game-title"></h2>
        <h3 id="level-title"></h3>

        <div id="quiz-game">
            <h3 id="question"></h3>
            <div class="choices"></div>
        </div>

       
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




</body>
</html>

