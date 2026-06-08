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

        <div class="game-card" data-game="quiz" onclick="startGame('quiz')">
            <div class="game-emoji">🚦</div>
            <h3>Verkeersquiz</h3>
            <p>Test je kennis met 35+ verkeersvragen.</p>
        </div>

        <div class="game-card" data-game="obstacle" onclick="startGame('obstacle')">
            <div class="game-emoji">🚗</div>
            <h3>Obstakel game</h3>
            <p>Rijd en ontwijk obstakels zo lang mogelijk.</p>
        </div>

        <div class="game-card" data-game="reaction" onclick="startGame('reaction')">
            <div class="game-emoji">⚡</div>
            <h3>Reactie test</h3>
            <p>Klik zo snel mogelijk als het verkeerslicht groen wordt.</p>
        </div>

        <div class="game-card" data-game="hazard" onclick="startGame('hazard')">
            <div class="game-emoji">⚠️</div>
            <h3>Gevaar herkennen</h3>
            <p>Kies wat je moet doen in gevaarlijke verkeerssituaties.</p>
        </div>

        <div class="game-card" data-game="signs" onclick="startGame('signs')">
            <div class="game-emoji">🪧</div>
            <h3>Verkeersborden raden</h3>
            <p>Kijk naar het bord en kies de juiste betekenis.</p>
        </div>

        <div class="game-card" data-game="priority" onclick="startGame('priority')">
            <div class="game-emoji">🚸</div>
            <h3>Voorrang kiezen</h3>
            <p>Lees de situatie en kies wie er voorrang heeft.</p>
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
    <p>© 2026 Verkeersveiligheid | Gemaakt door Stuart en Yosef</p>
</footer>

<script src="js/game.js?v=5"></script>




</body>
</html>

