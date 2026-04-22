/* ======================
   ALGEMEEN
===================== */
let currentGame = null;
let score = 0;
let lives = 3;

/* ======================
   ELEMENTEN
===================== */
const gameSelect = document.getElementById("game-select");
const gameArea = document.getElementById("game-area");
const gameTitle = document.getElementById("game-title");

const quizGame = document.getElementById("quiz-game");
const obstacleWrapper = document.getElementById("obstacle-wrapper");
const memoryGame = document.getElementById("memory-game");

const questionEl = document.getElementById("question");
const choicesEl = document.querySelector(".choices");
const feedback = document.getElementById("feedback");
const scoreEl = document.getElementById("score");

// END SCREEN
const endScreen = document.getElementById("end-screen");
const endTitle = document.getElementById("end-title");
const endScore = document.getElementById("end-score");

/* ======================
   OBSTACLE FIX STATE
===================== */
let obstacleInterval = null;
let keys = {};
let eventBound = false;

/* ======================
   START / MENU
===================== */
function startGame(game) {
    currentGame = game;
    score = 0;
    lives = 3;
    updateStats();

    gameSelect.style.display = "none";
    gameArea.style.display = "block";
    endScreen.style.display = "none";

    quizGame.style.display = "none";
    obstacleWrapper.style.display = "none";
    memoryGame.style.display = "none";

    // STOP ALLE RUNNING GAMES
    if (obstacleInterval) {
        clearInterval(obstacleInterval);
        obstacleInterval = null;
    }

    if (game === "quiz") {
        gameTitle.textContent = "🚦 Verkeersquiz";
        quizGame.style.display = "block";
        currentQuestion = 0;
        loadQuizQuestion();
    }

    if (game === "obstacle") {
        gameTitle.textContent = "🚗 Ontwijk de obstakels";
        obstacleWrapper.style.display = "block";
        startObstacleGame();
    }

    if (game === "memory") {
        gameTitle.textContent = "🧠 Memory game";
        memoryGame.style.display = "block";
        loadMemoryGame();
    }
}

function backToMenu() {
    if (obstacleInterval) {
        clearInterval(obstacleInterval);
        obstacleInterval = null;
    }

    gameArea.style.display = "none";
    gameSelect.style.display = "flex";
    endScreen.style.display = "none";
}

/* ======================
   STATS
===================== */
function updateStats() {
    if (scoreEl) scoreEl.textContent = `Score: ${score}`;
}

/* ======================
   EINDSCHERM
===================== */
function showEndScreen(title, finalScore) {
    quizGame.style.display = "none";
    obstacleWrapper.style.display = "none";
    memoryGame.style.display = "none";

    gameArea.style.display = "none"; // 🔥 BELANGRIJK

    endScreen.style.display = "block";

    endTitle.textContent = title;
    endScore.textContent = `Jouw score: ${finalScore}`;
}

/* ======================
   QUIZ GAME
===================== */
let currentQuestion = 0;

const quizQuestions = [
{question:"Wat betekent rood licht?",choices:["Stop","Doorrijden","Gas geven"],correct:"Stop"},
{question:"Wat betekent groen licht?",choices:["Stoppen","Doorrijden","Achteruit"],correct:"Doorrijden"},
{question:"Wat betekent oranje licht?",choices:["Stoppen indien mogelijk","Gas geven","Niets"],correct:"Stoppen indien mogelijk"},
{question:"Wie heeft voorrang op een zebrapad?",choices:["Auto","Fiets","Voetganger"],correct:"Voetganger"},
{question:"Mag je fietsen op de stoep?",choices:["Ja","Nee"],correct:"Nee"},
{question:"Wat betekent een stopbord?",choices:["Rustig rijden","Volledig stoppen","Gas geven"],correct:"Volledig stoppen"},
{question:"Wat betekent een driehoekig bord?",choices:["Waarschuwing","Verplicht","Verbod"],correct:"Waarschuwing"},
{question:"Wat betekent een rond rood bord?",choices:["Verbod","Advies","Informatie"],correct:"Verbod"},
{question:"Wat betekent een blauw bord?",choices:["Verplicht","Verboden","Waarschuwing"],correct:"Verplicht"},
{question:"Wat moet je doen bij een sirene?",choices:["Doorrijden","Stoppen en ruimte maken","Niets"],correct:"Stoppen en ruimte maken"},
{question:"Wat betekent een fietspad bord?",choices:["Alleen fietsers","Auto's","Voetgangers"],correct:"Alleen fietsers"},
{question:"Mag je door rood fietsen?",choices:["Ja","Nee"],correct:"Nee"},
{question:"Wat doe je bij een spoorwegovergang?",choices:["Stoppen en kijken","Gas geven","Niet kijken"],correct:"Stoppen en kijken"},
{question:"Wat betekent een schoolzone?",choices:["Langzamer rijden","Sneller rijden","Parkeren"],correct:"Langzamer rijden"},
{question:"Wat betekent haaientanden?",choices:["Voorrang geven","Voorrang nemen","Stoppen"],correct:"Voorrang geven"},
{question:"Wat betekent een zebrapad?",choices:["Voetgangers voorrang","Auto voorrang","Geen regel"],correct:"Voetgangers voorrang"},
{question:"Mag je bellen op de fiets?",choices:["Ja","Nee"],correct:"Nee"},
{question:"Wat betekent een parkeerbord?",choices:["Parkeren toegestaan","Verboden","Stoppen"],correct:"Parkeren toegestaan"},
{question:"Wat doe je bij mist?",choices:["Sneller rijden","Langzamer rijden","Niets"],correct:"Langzamer rijden"},
{question:"Wat betekent een snelwegbord?",choices:["Autosnelweg","Fietspad","Parkeerplaats"],correct:"Autosnelweg"},
{question:"Wat betekent een maximum snelheid bord?",choices:["Max snelheid","Min snelheid","Geen regel"],correct:"Max snelheid"},
{question:"Wat betekent een stopstreep?",choices:["Stoppen","Doorrijden","Parkeren"],correct:"Stoppen"},
{question:"Wat betekent een voorrangsbord?",choices:["Voorrang nemen","Voorrang geven","Stoppen"],correct:"Voorrang nemen"},
{question:"Wat doe je bij regen?",choices:["Sneller","Langzamer","Niets"],correct:"Langzamer"},
{question:"Wat betekent een rotonde bord?",choices:["Rotonde","Stop","Parkeer"],correct:"Rotonde"},
{question:"Wie heeft voorrang op een rotonde?",choices:["Auto op rotonde","Auto die komt","Fiets"],correct:"Auto op rotonde"},
{question:"Wat betekent een doodlopende weg?",choices:["Geen doorgang","Sneller rijden","Parkeren"],correct:"Geen doorgang"},
{question:"Wat betekent een verboden in te halen bord?",choices:["Niet inhalen","Wel inhalen","Sneller"],correct:"Niet inhalen"},
{question:"Wat betekent een werk in uitvoering bord?",choices:["Gevaar","Parkeren","Sneller"],correct:"Gevaar"},
{question:"Wat betekent een kind symbool bord?",choices:["Schoolzone","Parkeerplaats","Autosnelweg"],correct:"Schoolzone"},
{question:"Wat doe je bij een kruispunt zonder borden?",choices:["Rechts heeft voorrang","Links","Niemand"],correct:"Rechts heeft voorrang"},
{question:"Wat betekent een blauwe P?",choices:["Parkeren","Verboden","Stop"],correct:"Parkeren"},
{question:"Wat betekent een busbaan?",choices:["Alleen bus","Iedereen","Fiets"],correct:"Alleen bus"},
{question:"Wat betekent een fietsstrook?",choices:["Fietsers","Auto","Voetgangers"],correct:"Fietsers"},
{question:"Wat betekent een waarschuwingsbord?",choices:["Let op","Stop","Rijden"],correct:"Let op"}
];

function loadQuizQuestion() {
    if (currentQuestion >= quizQuestions.length) {
        showEndScreen("🏁 Quiz voltooid!", `${score}/${quizQuestions.length}`);
        return;
    }

    const q = quizQuestions[currentQuestion];
    questionEl.textContent = q.question;
    choicesEl.innerHTML = "";
    feedback.textContent = "";

    q.choices.forEach(choice => {
        const btn = document.createElement("button");
        btn.textContent = choice;

        btn.onclick = () => {
            if (choice === q.correct) {
                feedback.textContent = "✅ Correct!";
                score++;
            } else {
                feedback.textContent = "❌ Fout!";
            }

            const user = JSON.parse(localStorage.getItem("user"));

if(user){
    fetch("backend/save_quiz.php", {
        method: "POST",
        body: new URLSearchParams({
            user_id: user.id,
            question: q.question,
            given_answer: choice,
            correct_answer: q.correct,
            is_correct: choice === q.correct ? 1 : 0,
            score: score
        })
    });
}

            updateStats();
            currentQuestion++;
            setTimeout(loadQuizQuestion, 800);
        };

        choicesEl.appendChild(btn);
    });
}

/* ======================
   OBSTACLE GAME
===================== */
const canvas = document.getElementById("obstacle-game");
const ctx = canvas ? canvas.getContext("2d") : null;

let car = { x: 220, y: 330, w: 60, h: 60 };
let obstacles = [];
let obstacleSpeed = 4;

const carImg = new Image();
carImg.src = "images/car.png";

const obstacleImg = new Image();
obstacleImg.src = "images/cone.png";

function startObstacleGame() {
    if (!canvas || !ctx) return;

    score = 0;
    obstacleSpeed = 4;
    obstacles = [];
    updateStats();

    keys = {};

    if (obstacleInterval) clearInterval(obstacleInterval);

    if (!eventBound) {
        document.addEventListener("keydown", e => keys[e.key] = true);
        document.addEventListener("keyup", e => keys[e.key] = false);
        eventBound = true;
    }

    obstacleInterval = setInterval(gameLoop, 20);
}

function gameLoop() {
    if (!ctx) return;

    ctx.clearRect(0, 0, 500, 400);
    ctx.fillStyle = "#3b7a57";
    ctx.fillRect(0, 0, 500, 400);

    if (keys["ArrowLeft"]) car.x -= 6;
    if (keys["ArrowRight"]) car.x += 6;

    ctx.drawImage(carImg, car.x, car.y, car.w, car.h);

    if (Math.random() < 0.03) {
        obstacles.push({ x: Math.random() * 450, y: -60, w: 50, h: 50 });
    }

    obstacles.forEach((o, i) => {
        o.y += obstacleSpeed;

        ctx.drawImage(obstacleImg, o.x, o.y, o.w, o.h);

        if (
            car.x < o.x + o.w &&
            car.x + car.w > o.x &&
            car.y < o.y + o.h &&
            car.y + car.h > o.y
        ) {
            clearInterval(obstacleInterval);
            obstacleInterval = null;
            showEndScreen("💥 Game Over!", score);
        }

        if (o.y > 400) {
            score++;
            obstacleSpeed += 0.2;

            const obstacleScore = document.getElementById("obstacle-score");
            if (obstacleScore) obstacleScore.textContent = score;

            obstacles.splice(i, 1);
        }
    });
}

/* ======================
   MEMORY GAME
===================== */
const symbols = ["🚗","🚲","🚦","🛑","🚸","⚠️","🚕","🚌"];

let cards = [];
let flipped = [];

function loadMemoryGame() {
    memoryGame.innerHTML = "";

    memoryGame.style.display = "grid";
    memoryGame.style.gridTemplateColumns = "repeat(4, 80px)";
    memoryGame.style.gap = "15px";
    memoryGame.style.justifyContent = "center";

    score = 0;
    updateStats();

    cards = [...symbols, ...symbols].sort(() => Math.random() - 0.5);

    cards.forEach(symbol => {
        const card = document.createElement("button");

        card.style.width = "80px";
        card.style.height = "80px";
        card.style.fontSize = "30px";
        card.style.borderRadius = "10px";

        card.textContent = "❓";

        card.onclick = () => {
            if (flipped.length < 2 && card.textContent === "❓") {
                card.textContent = symbol;
                flipped.push({ card, symbol });

                if (flipped.length === 2) {
                    if (flipped[0].symbol === flipped[1].symbol) {
                        score++;
                        updateStats();
                        flipped = [];

                        if (score === symbols.length) {
                            showEndScreen("🏁 Memory voltooid!", score);
                        }
                    } else {
                        setTimeout(() => {
                            flipped[0].card.textContent = "❓";
                            flipped[1].card.textContent = "❓";
                            flipped = [];
                        }, 700);
                    }
                }
            }
        };

        memoryGame.appendChild(card);
    });
}
fetch("backend/save_quiz.php", {
    method: "POST",
    body: new URLSearchParams({
        user_id: JSON.parse(localStorage.getItem("user")).id,
        question: q.question,
        given_answer: choice,
        correct_answer: q.correct,
        is_correct: choice === q.correct ? 1 : 0,
        score: score
    })
});
function login() {
    fetch("backend/login.php", {
        method: "POST",
        body: new URLSearchParams({
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        })
    })
    .then(r => r.json())
    .then(data => {
        if(data.id){
            localStorage.setItem("user", JSON.stringify(data));
            window.location.href = "game.html";
        }
    });
}


