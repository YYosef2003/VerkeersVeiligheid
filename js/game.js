
/* ======================
   ALGEMEEN
===================== */
let currentGame = null;
let lastGame = null; 
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
    lastGame = game;
    
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
    const questionElement = document.getElementById("question");
    const choicesElement = document.querySelector(".choices");
    const feedbackElement = document.getElementById("feedback");

    if (!questionElement || !choicesElement) {
        console.error("Quiz elementen niet gevonden");
        return;
    }

   if (currentQuestion >= quizQuestions.length) {
    showEndScreen("🏁 Quiz voltooid!", `${score}/${quizQuestions.length}`);
    return;
}

    const q = quizQuestions[currentQuestion];

    questionElement.textContent = q.question;
    choicesElement.innerHTML = "";
    if (feedbackElement) feedbackElement.textContent = "";

    q.choices.forEach(choice => {
        const btn = document.createElement("button");
        btn.textContent = choice;

        btn.onclick = () => {
            const isCorrect = choice === q.correct;

            if (isCorrect) {
                if (feedbackElement) feedbackElement.textContent = "✅ Correct!";
                score++;
            } else {
                if (feedbackElement) feedbackElement.textContent = "❌ Fout!";
            }

            const user = JSON.parse(localStorage.getItem("user"));

            if (user && user.id) {
                fetch("backend/save_quiz.php", {
                    method: "POST",
                    body: new URLSearchParams({
                        user_id: user.id,
                        question: q.question,
                        given_answer: choice,
                        correct_answer: q.correct,
                        is_correct: isCorrect ? 1 : 0,
                        score: score
                    })
                })
                .then(res => res.json())
        .then(data => console.log("Quiz opgeslagen:", data));
            }

            updateStats();
            currentQuestion++;
            setTimeout(loadQuizQuestion, 800);
        };

        choicesElement.appendChild(btn);
    });
}

            

/* ======================
   OBSTACLE GAME + COINS
===================== */
const canvas = document.getElementById("obstacle-game");
const ctx = canvas ? canvas.getContext("2d") : null;

let car = { x: 220, y: 330, w: 60, h: 60 };
let obstacles = [];
let coins = [];
let obstacleSpeed = 4;

const carImg = new Image();
carImg.src = "images/car2.png";

const obstacleImg = new Image();
obstacleImg.src = "images/cone.webp";

const coinImg = new Image();
coinImg.src = "images/coin.png";

function startObstacleGame() {
    if (!canvas || !ctx) return;

    score = 0;
    obstacleSpeed = 4;
    obstacles = [];
    coins = [];
    car.x = 220;
    car.y = 330;

    updateStats();
    keys = {};

    if (obstacleInterval) {
        clearInterval(obstacleInterval);
    }

    if (!eventBound) {
        document.addEventListener("keydown", e => {
            keys[e.key] = true;
        });

        document.addEventListener("keyup", e => {
            keys[e.key] = false;
        });

        eventBound = true;
    }

    obstacleInterval = setInterval(gameLoop, 20);
}

function restartGame() {
    console.log("Restart klik:", currentGame, lastGame);

    if (!lastGame) {
        alert("Geen game gevonden om opnieuw te starten");
        return;
    }

    if (obstacleInterval) {
        clearInterval(obstacleInterval);
        obstacleInterval = null;
    }

    endScreen.style.display = "none";
    gameArea.style.display = "block";
    gameSelect.style.display = "none";

    startGame(lastGame);
}
function gameLoop() {
    if (!ctx) return;

    ctx.clearRect(0, 0, 500, 400);

    // achtergrond
    ctx.fillStyle = "#3b7a57";
    ctx.fillRect(0, 0, 500, 400);

    // beweging
    if (keys["ArrowLeft"]) car.x -= 6;
    if (keys["ArrowRight"]) car.x += 6;

    if (car.x < 0) car.x = 0;
    if (car.x + car.w > 500) car.x = 500 - car.w;

    // auto tekenen
    ctx.drawImage(carImg, car.x, car.y, car.w, car.h);

    /* ======================
       COINS SPAWN
    ====================== */
    if (Math.random() < 0.02) {
        coins.push({
            x: Math.random() * 450,
            y: -40,
            size: 30
        });
    }

    /* ======================
       OBSTAKELS SPAWN
    ====================== */
    if (Math.random() < 0.03) {
        obstacles.push({
            x: Math.random() * 450,
            y: -60,
            w: 50,
            h: 50
        });
    }

    /* ======================
       OBSTAKELS LOGICA
    ====================== */
    for (let i = obstacles.length - 1; i >= 0; i--) {
        const o = obstacles[i];
        o.y += obstacleSpeed;

        ctx.drawImage(obstacleImg, o.x, o.y, o.w, o.h);

        const hit =
            car.x < o.x + o.w &&
            car.x + car.w > o.x &&
            car.y < o.y + o.h &&
            car.y + car.h > o.y;

        if (hit) {
            clearInterval(obstacleInterval);
            obstacleInterval = null;

            saveObstacleScore(score);
            showEndScreen("💥 Game Over!", score);
            return;
        }

        if (o.y > 400) {
            score++;
            obstacleSpeed += 0.2;
            updateStats();
            obstacles.splice(i, 1);
        }
    }

    /* ======================
       COINS LOGICA
    ====================== */
    for (let i = coins.length - 1; i >= 0; i--) {
        const c = coins[i];
        c.y += obstacleSpeed;

        if (coinImg.complete && coinImg.naturalWidth > 0) {
            ctx.drawImage(coinImg, c.x, c.y, c.size, c.size);
        } else {
            ctx.fillStyle = "gold";
            ctx.beginPath();
            ctx.arc(c.x + c.size / 2, c.y + c.size / 2, c.size / 2, 0, Math.PI * 2);
            ctx.fill();
        }

        const hit =
            car.x < c.x + c.size &&
            car.x + car.w > c.x &&
            car.y < c.y + c.size &&
            car.y + car.h > c.y;

        if (hit) {
            score += 2;
            updateStats();
            coins.splice(i, 1);
            continue;
        }

        if (c.y > 400) {
            coins.splice(i, 1);
        }
    }
}

function saveObstacleScore(finalScore) {
    const user = JSON.parse(localStorage.getItem("user"));

    if (!user || !user.id) {
        alert("Je moet ingelogd zijn");
        return;
    }

    fetch("backend/save_score.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            user_id: user.id,
            player_name: user.username,
            score: finalScore
        })
    })
    .then(res => res.json())
    .then(data => console.log("Score opgeslagen:", data))
    .catch(err => console.error(err));
}
