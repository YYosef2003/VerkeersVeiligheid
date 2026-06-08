<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkeersveiligheid | Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>


<section class="hero">
    <div class="emoji-bg">
        <span>🚗</span>
        <span>🚲</span>
        <span>🛴</span>
        <span>🚦</span>
        <span>⚠️</span>
        <span>🚸</span>

    </div>


    <h2>Veilig door het verkeer</h2>
    <p>
        Leer hoe jij veilig kunt deelnemen aan het verkeer.<br>
        Test je kennis en skills met interactieve games 🎮
    </p>
    <a href="game.php" class="button">🎮 Speel de games</a>
</section>


<section class="info-strip">
    <p>
        🚨 Wist je dat de meeste verkeersongelukken bij jongeren gebeuren door afleiding?
        <strong>Tijd om dat te veranderen.</strong>
    </p>
</section>


<section class="cards">
    <div class="card" onclick="window.location.href='info.php'" style="cursor:pointer;">
        <div class="card-emoji">📘</div>
        <h3>Leren</h3>
        <p>Ontdek verkeersregels, borden en gevaarlijke situaties.</p>
    </div>

    <div class="card" onclick="window.location.href='game.php'" style="cursor:pointer;">
        <div class="card-emoji">🧠</div>
        <h3>Oefenen</h3>
        <p>Train je brein met quizzen en realistische verkeersscenario’s.</p>
    </div>

    <div class="card" onclick="window.location.href='highscores.php'" style="cursor:pointer;">
        <div class="card-emoji">🏆</div>
        <h3>Verbeteren</h3>
        <p>Bekijk je highscores, vergelijk je resultaten en verbeter jezelf.</p>
    </div>
</section>


<section class="hero">
    <div class="emoji-bg small">
        <span>🚦</span><span>⚠️</span><span>🚲</span><span>🚗</span>
        <span>🛑</span><span>🎉</span>
    </div>

    <h2>Ben jij klaar voor de challenge? 💥</h2>
    <p>Speel interactieve games en test hoe verkeersveilig jij echt bent.</p>
    <a href="game.php" class="button">🚦 Start de challenge</a>
</section>

<footer>
    <p>© 2026 Verkeersveiligheid | Gemaakt voor jongeren 🚀</p>
</footer>

</body>
</html>
