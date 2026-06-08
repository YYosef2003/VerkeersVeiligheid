<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <h1>🚦 Verkeersveiligheid</h1>

    <div class="navbar">
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Menu openen">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav-left" id="nav-menu">
            <a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Home</a>
            <a href="info.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'info.php') ? 'active' : ''; ?>">Verkeersveiligheid</a>
            <a href="game.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'game.php') ? 'active' : ''; ?>">Game</a>
            <a href="Contact.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'Contact.php') ? 'active' : ''; ?>">Contact</a>
            <a href="Over-ons.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'Over-ons.php') ? 'active' : ''; ?>">Over Ons</a>
            <a href="les-pakketten.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'les-pakketten.php') ? 'active' : ''; ?>">Les pakketten</a>
            <a href="highscores.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'highscores.php') ? 'active' : ''; ?>">Highscores</a>
            <a href="results.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'results.php') ? 'active' : ''; ?>">Mijn resultaten</a>
        </nav>

        <div class="nav-right">
            <span id="logged-user" style="display:none;"></span>
            <a href="login.php" id="login-btn" class="auth-btn" style="display:none;">Login</a>
            <a href="register.php" id="register-btn" class="auth-btn" style="display:none;">Registreren</a>
            <a href="profile.php" id="profile-link" class="auth-btn" style="display:none;">Profiel</a>
            <button id="logout-btn" class="auth-btn" onclick="logout()" style="display:none;">Uitloggen</button>
        </div>
    </div>
</header>

<script src="js/navbar.js"></script>