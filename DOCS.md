# Projectdocumentatie: Verkeersveiligheid

## Overzicht
Dit project is een educatieve website over verkeersveiligheid, met een frontend van meerdere PHP-pagina's, een JavaScript-gamemodule en een backend voor gebruikersauthenticatie, quizopslag en highscores.

### Belangrijke secties
- Publieke pagina's: `index.php`, `info.php`, `Contact.php`, `Over-ons.php`, `game.php`, `highscores.php`, `profile.php`, `results.php`, `login.php`, `register.php`
- Backend API: `backend/*.php`
- Frontend scripts: `js/*.js`
- Styling: `css/style.css`
- Herbruikbaar fragment: `includes/navbar.php`

---

## Pagina's

### `index.php`
- Startpagina met hero-secties en call-to-action naar de games.
- Linkt naar de algemene stylesheet `css/style.css`.
- Include van `includes/navbar.php` voor navigatie.

### `info.php`
- Educatieve pagina over verkeersveiligheid, gevaarlijke situaties en zomaatregelen.
- Toont statische content in kaartjes en call-to-action naar de gamepagina.

### `Contact.php`
- Contactpagina met een formulier voor naam, e-mail, onderwerp en bericht.
- Versturing is client-side gesimuleerd met `submitContactForm()` in een inline script.

### `Over-ons.php`
- Statistische «over ons»-pagina met missie, visie en teaminformatie.

### `game.php`
- Gamehub met keuze tussen:
  - Verkeersquiz
  - Obstakelgame
- Bevat de secties voor game-selectie, game-area en end-screen.
- Laadt `js/game.js` voor alle game-logica.

### `highscores.php`
- Pagina voor het tonen van de persoonlijke beste score en de top 10 leaderboard.
- Laadt `js/highscores.js` om scores vanuit de backend op te halen.

### `profile.php`
- Toont de quizresultaten van de ingelogde gebruiker.
- Laadt `js/profile.js`.

### `results.php`
- Toont gebruikersantwoorden en quizresultaten.
- Laadt `js/results.js`.

### `login.php`
- Loginpagina met gebruikersnaam- en wachtwoordvelden.
- Roept `login()` aan uit `js/login.js`.
- Gebruikt `js/navbar.js` om de navigatie te updaten.

### `register.php`
- Registratiepagina met formulier voor gebruikersnaam, e-mail en wachtwoord.
- Inline JavaScript verstuurt registratiegegevens naar `backend/session_handler.php`.

---

## Includes

### `includes/navbar.php`
- Centrale navigatie-header die op bijna alle pagina's wordt ingeladen.
- Toont links naar de belangrijkste pagina's.
- Heeft een dynamisch gedeelte met:
  - `logged-user`
  - `login-btn`
  - `register-btn`
  - `profile-link`
  - `logout-btn`
- Laadt `js/navbar.js` voor de login/uitlog-status.

---

## Frontend JavaScript

### `js/game.js`
Verantwoordelijk voor de spelervaring en quizlogica.

Belangrijke functies:
- `startGame(game)`
  - Start de geselecteerde game (quiz, obstacle of memory).
  - Reset score en UI.
- `backToMenu()`
  - Keert terug naar het hoofdmenu en stopt eventueel lopende intervals.
- `updateStats()`
  - Werkt het score-element bij.
- `showEndScreen(title, finalScore)`
  - Laat het eindscherm zien met titel en score.
- `loadQuizQuestion()`
  - Laadt de huidige quizvraag uit `quizQuestions`.
  - Maakt knoppen voor antwoorden.
  - Slaat quizantwoorden op via `backend/save_quiz.php`.
- `startObstacleGame()`
  - Start de obstakelgame, initialiseert canvas en event listeners.
- `gameLoop()`
  - Verwerkt de frames van de obstakelgame.
  - Beweegt de auto en vallen obstakels en munten naar beneden.
  - Detecteert botsingen en scoreverhogingen.
- `restartGame()`
  - Herstart de laatst gespeelde game.
- `saveObstacleScore(finalScore)`
  - Stuurt de score naar `backend/save_score.php` wanneer de speler verliest.

Extra data:
- `quizQuestions` bevat 35+ vragen met keuzes en correcte antwoorden.
- Obstakelgame gebruikt afbeeldingen `images/car2.png`, `images/cone.webp` en `images/coin.png`.

### `js/login.js`
- `login()` verstuurt username en password naar `backend/session_handler.php`.
- Bij succes wordt de gebruiker in `localStorage` opgeslagen en doorgestuurd naar `game.php`.
- Toont foutmeldingen bij mislukte login.
- Bij DOMContentLoaded zet het een tekst in `#logged-user`.

### `js/profile.js`
- Haalt via `backend/get_quiz_results.php?user_id=...` quizresultaten op voor de ingelogde gebruiker.
- Toont de resultaten in het profielscherm.

### `js/highscores.js`
- Haalt de persoonlijke top-score op via `backend/get_my_highscore.php?user_id=...`.
- Haalt de globale top 10 op via `backend/get_scores.php`.
- Rendered beide scoreoverzichten als HTML.

### `js/navbar.js`
- `updateNavbar()` toont of verbergt knoppen afhankelijk van login-status.
- `logout()` verwijdert `user` uit `localStorage`, roept `backend/session_handler.php?action=logout` aan en stuurt door naar `index.php`.
- `clearUser()` wist logingegevens uit lokale opslag.

### `js/results.js`
- Laadt quizresultaten voor de huidige gebruiker via `backend/get_quiz_results.php`.
- Rendered vraag, gegeven antwoord, correct antwoord, resultaat en score.

---

## Backend PHP

### `backend/db.php`
- Maakt een PDO-verbinding met de database `crossyroad` op `localhost`.
- Gebruikt gebruikersnaam `root` zonder wachtwoord.

### `backend/session_handler.php`
- Verwerkt drie acties:
  - `login`
  - `logout`
  - `register`
- Beheert sessies met `session_start()`.
- Login en registratie gebruiken PDO en veilige password hashing/verificatie.
- `register` controleert of gebruikersnaam of e-mail al bestaat.

### `backend/login.php`
- Een losse login-endpoint dat vergelijkbare loginfunctionaliteit biedt met mysqli.
- Retourneert JSON met `success`, id en gebruikersnaam.

### `backend/register.php`
- Registreert een nieuwe gebruiker met gebruikersnaam, e-mail en hash-wachtwoord.
- Maakt een nieuwe rij in de tabel `users`.

### `backend/save_quiz.php`
- Ontvangt quizdata via `POST`.
- Slaat quizvraag, gegeven antwoord, correct antwoord, juistheid en score op in `quiz_results`.

### `backend/save_score.php`
- Ontvangt game scores via JSON in de request body.
- Slaat een entry in `highscores` met `user_id`, `player_name`, `score`.

### `backend/get_my_highscore.php`
- Levert de beste score terug voor een specifieke gebruiker.
- Filtert op `user_id` en sorteert op score.

### `backend/get_scores.php`
- Levert de top 10 hoogste scores terug van alle spelers.
- Gebruikt `GROUP BY player_name` en `MAX(score)`.

### `backend/get_quiz_results.php`
- Levert alle quizresultaten terug van een gebruiker.
- Gebruikt `mysqli` en retourneert JSON met alle rijen uit `quiz_results`.

### `backend/index.php`
- Een aparte pagina die een klassiek Crossy Road-scorescherm lijkt te tonen.
- Deze backend-pagina is niet direct verbonden met de frontend van de hoofdsite.
- Gebruikt nog een eigen `style.css`/`script.js` in de `backend` map.

---

## Styles

### `css/style.css`
- Algemene layout en styling voor de site:
  - Headers, navigatie, hero-secties, kaarten, knoppen, forms.
  - Game-specifieke stijlen voor quizknoppen en canvas.
  - Responsieve layout voor mobiele schermen.
- Bevat ook styling voor het backend Crossy Road-UI in dezelfde stylesheet.

---

## Database-structuur (afgeleid)

De code gebruikt ten minste de volgende tabellen:
- `users` met `id`, `username`, `email`, `password`
- `quiz_results` met `user_id`, `question`, `given_answer`, `correct_answer`, `is_correct`, `score`, `created_at`
- `highscores` met `user_id`, `player_name`, `score`, `created_at`

---

## Opmerkingen

- De frontend gebruikt `localStorage` om ingelogde gebruikers te onthouden.
- Sommige backendbestanden gebruiken PDO (`db.php`, `session_handler.php`, `save_quiz.php`, `save_score.php`), terwijl andere nog `mysqli` gebruiken (`get_scores.php`, `get_quiz_results.php`, `login.php`, `register.php`).
- `backend/index.php` lijkt een aparte scorepagina voor een Crossy Road-variant en niet direct onderdeel van de hoofdsite.
- `register.php` bevat inline JavaScript voor registratie, terwijl `login.php` een extern script gebruikt.

---

## Aanbevelingen

- Consistent gebruik van één database-extensie (PDO of mysqli) verbeteren.
- Eventueel `backend/index.php` opnemen in projectdocumentatie of verwijderen wanneer het niet gebruikt wordt.
- De `memoryGame`-sectie in `game.js` is aanwezig, maar lijkt nog niet volledig geïmplementeerd.
- `js/game.js` kan opgesplitst worden in kleinere modules voor quiz, obstacle en UI.
