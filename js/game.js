

let currentGame = null;
let lastGame = null; 
let score = 0;
let lives = 3;


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


const endScreen = document.getElementById("end-screen");
const endTitle = document.getElementById("end-title");
const endScore = document.getElementById("end-score");


let obstacleInterval = null;
let keys = {};
let eventBound = false;


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
    memoryGame.innerHTML = "";

    
    if (obstacleInterval) {
        clearInterval(obstacleInterval);
        obstacleInterval = null;
    }
    if (reactionTimeout) {
        clearTimeout(reactionTimeout);
        reactionTimeout = null;
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

    if (game === "reaction") {
        gameTitle.textContent = "⚡ Reactie test";
        memoryGame.style.display = "block";
        startReactionGame();
    }

    if (game === "hazard") {
        gameTitle.textContent = "⚠️ Gevaar herkennen";
        memoryGame.style.display = "block";
        startHazardGame();
    }

    if (game === "signs") {
        gameTitle.textContent = "🪧 Verkeersborden raden";
        memoryGame.style.display = "block";
        startSignsGame();
    }

    if (game === "priority") {
        gameTitle.textContent = "🚸 Voorrang kiezen";
        memoryGame.style.display = "block";
        startPriorityGame();
    }

    if (!["quiz", "obstacle", "memory", "reaction", "hazard", "signs", "priority"].includes(game)) {
        gameTitle.textContent = "Game niet gevonden";
        memoryGame.style.display = "block";
        memoryGame.innerHTML = `<div class="mini-game-box"><p>Deze game bestaat niet: ${game}</p></div>`;
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


function updateStats() {
    if (scoreEl) scoreEl.textContent = `Score: ${score}`;
}


function showEndScreen(title, finalScore) {
    quizGame.style.display = "none";
    obstacleWrapper.style.display = "none";
    memoryGame.style.display = "none";
    memoryGame.innerHTML = "";

    gameArea.style.display = "none";

    endScreen.style.display = "block";

    endTitle.textContent = title;
    endScore.textContent = `Jouw score: ${finalScore}`;
}


let currentQuestion = 0;

const quizQuestions = [
{question:"Wat betekent rood licht?",choices:["Stop","Doorrijden","Gas geven"],correct:"Stop"},
{question:"Wat betekent groen licht?",choices:["Stoppen","Doorrijden","Achteruit"],correct:"Doorrijden"},
{question:"Wat betekent oranje licht?",choices:["Stoppen indien mogelijk","Gas geven","Niets"],correct:"Stoppen indien mogelijk"},
{question:"Wie heeft voorrang op een zebrapad?",choices:["Auto","Fiets","Voetganger"],correct:"Voetganger"},
{question:"Mag je fietsen op de stoep?",choices:["Ja","Nee"],correct:"Nee"},
{question:"Wat betekent een stopbord?",choices:["Rustig rijden","Volledig stoppen","Gas geven"],correct:"Volledig stoppen"},
{question:"Wat betekent een driehoekig bord?",choices:["Waarschuwing","Verplicht","Verbod"],correct:"Waarschuwing"},
{question:"Wat betekent  dit bord ⛔?",choices:["Verbod","Advies","Informatie"],correct:"Verbod"},
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

            


const canvas = document.getElementById("obstacle-game");
const ctx = canvas ? canvas.getContext("2d") : null;

let car = { x: 220, y: 330, w: 60, h: 60 };
let obstacles = [];
let coins = [];
let obstacleSpeed = 4;

const carImg = new Image();
carImg.src = "images/car.png";

const obstacleImg = new Image();
obstacleImg.src = "images/cone.webp";

const coinImg = new Image();
coinImg.src = "images/coin.png";

function startObstacleGame() {
     document.getElementById("obstacle-wrapper").scrollIntoView({
        behavior: "smooth"
    });

    obstacleWrapper.style.display = "block";


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

    
    ctx.fillStyle = "#3b7a57";
    ctx.fillRect(0, 0, 500, 400);

    
    if (keys["ArrowLeft"]) car.x -= 6;
    if (keys["ArrowRight"]) car.x += 6;

    if (car.x < 0) car.x = 0;
    if (car.x + car.w > 500) car.x = 500 - car.w;

   
    ctx.drawImage(carImg, car.x, car.y, car.w, car.h);

    
    if (Math.random() < 0.02) {
        coins.push({
            x: Math.random() * 450,
            y: -40,
            size: 30
        });
    }

 
    if (Math.random() < 0.03) {
        obstacles.push({
            x: Math.random() * 450,
            y: -60,
            w: 50,
            h: 50
        });
    }

    
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

function saveGameScore(finalScore, gameName = currentGame) {
    const user = JSON.parse(localStorage.getItem("user"));

    if (!user || !user.id) {
        alert("Je moet ingelogd zijn om je highscore op te slaan");
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
            score: finalScore,
            game_name: gameName
        })
    })
    .then(res => res.json())
    .then(data => console.log("Score opgeslagen:", data))
    .catch(err => console.error(err));
}

function saveObstacleScore(finalScore) {
    saveGameScore(finalScore, "obstacle");
}


/* ======================
   EXTRA GAME 1: REACTIE TEST
====================== */
let reactionTimeout = null;
let reactionStartTime = 0;

function startReactionGame() {
    score = 0;
    updateStats();
    feedback.textContent = "Wacht tot het licht groen wordt...";

    memoryGame.innerHTML = `
        <div class="mini-game-box">
            <div id="traffic-light" class="traffic-light red-light">ROOD</div>
            <p>Klik pas als het licht GROEN wordt.</p>
            <button id="reaction-btn" class="button">Klik hier</button>
        </div>
    `;

    const light = document.getElementById("traffic-light");
    const btn = document.getElementById("reaction-btn");
    let canClick = false;

    reactionTimeout = setTimeout(() => {
        canClick = true;
        reactionStartTime = Date.now();
        light.textContent = "GROEN";
        light.className = "traffic-light green-light";
        feedback.textContent = "Klik nu zo snel mogelijk!";
    }, Math.floor(Math.random() * 2500) + 1500);

    btn.onclick = () => {
        if (!canClick) {
            clearTimeout(reactionTimeout);
            showEndScreen("❌ Te vroeg geklikt!", 0);
            return;
        }

        const reactionTime = Date.now() - reactionStartTime;
        let points = Math.max(1, Math.round(1000 / reactionTime * 100));
        score = points;
        updateStats();
        saveGameScore(score, "reaction");
        showEndScreen(`⚡ Reactietijd: ${reactionTime} ms`, score);
    };
}

/* ======================
   EXTRA GAME 2: GEVAAR HERKENNEN
====================== */
let hazardIndex = 0;

const hazardQuestions = [
    {
        situation: "Je fietst en je vriend stuurt een appje. Wat doe je?",
        choices: ["Tijdens het fietsen lezen", "Stoppen op een veilige plek", "Sneller fietsen"],
        correct: "Stoppen op een veilige plek"
    },
    {
        situation: "Het regent hard en de weg is glad. Wat is veilig?",
        choices: ["Rustiger rijden", "Harder remmen", "Met losse handen fietsen"],
        correct: "Rustiger rijden"
    },
    {
        situation: "Bij een zebrapad wil iemand oversteken. Wat doe je als bestuurder?",
        choices: ["Door blijven rijden", "Stoppen en voorrang geven", "Toeteren"],
        correct: "Stoppen en voorrang geven"
    },
    {
        situation: "Je komt bij een kruispunt zonder borden. Wie heeft meestal voorrang?",
        choices: ["Verkeer van rechts", "Verkeer van links", "Degene die het snelst rijdt"],
        correct: "Verkeer van rechts"
    },
    {
        situation: "Je rijdt langs een school waar kinderen lopen. Wat doe je?",
        choices: ["Langzamer en extra opletten", "Hard optrekken", "Op je telefoon kijken"],
        correct: "Langzamer en extra opletten"
    }
];

function startHazardGame() {
    score = 0;
    hazardIndex = 0;
    updateStats();
    feedback.textContent = "";
    loadHazardQuestion();
}

function loadHazardQuestion() {
    if (hazardIndex >= hazardQuestions.length) {
        saveGameScore(score, "hazard");
        showEndScreen("🏁 Gevaar herkennen voltooid!", `${score}/${hazardQuestions.length}`);
        return;
    }

    const q = hazardQuestions[hazardIndex];
    memoryGame.innerHTML = `
        <div class="mini-game-box">
            <h3>Situatie ${hazardIndex + 1}</h3>
            <p class="hazard-situation">${q.situation}</p>
            <div id="hazard-choices" class="choices"></div>
        </div>
    `;

    const choices = document.getElementById("hazard-choices");
    q.choices.forEach(choice => {
        const btn = document.createElement("button");
        btn.textContent = choice;
        btn.onclick = () => {
            if (choice === q.correct) {
                score++;
                feedback.textContent = "✅ Goed gekozen!";
            } else {
                feedback.textContent = `❌ Niet helemaal. Goed antwoord: ${q.correct}`;
            }

            updateStats();
            hazardIndex++;
            setTimeout(loadHazardQuestion, 1000);
        };
        choices.appendChild(btn);
    });
}


/* ======================
   EXTRA GAME 3: VERKEERSBORDEN RADEN
====================== */
let signsIndex = 0;

const signsQuestions = [
    {
        emoji: "🛑",
        sign: "STOP",
        question: "Wat betekent dit bord?",
        choices: ["Je moet volledig stoppen", "Je mag hier parkeren", "Je moet sneller rijden"],
        correct: "Je moet volledig stoppen"
    },
    {
        emoji: "⛔",
        sign: "Verboden in te rijden",
        question: "Wat betekent dit bord?",
        choices: ["Je mag deze weg niet in", "Je moet rechtdoor", "Hier is een fietspad"],
        correct: "Je mag deze weg niet in"
    },
    {
        emoji: "🚸",
        sign: "Overstekende kinderen",
        question: "Waar moet je extra op letten?",
        choices: ["Kinderen kunnen oversteken", "Alleen vrachtwagens", "Je mag hier racen"],
        correct: "Kinderen kunnen oversteken"
    },
    {
        emoji: "🚲",
        sign: "Fietspad",
        question: "Voor wie is dit bord vooral bedoeld?",
        choices: ["Fietsers", "Vliegtuigen", "Treinen"],
        correct: "Fietsers"
    },
    {
        emoji: "🅿️",
        sign: "Parkeren",
        question: "Wat mag je hier doen?",
        choices: ["Parkeren", "Niet stoppen", "Alleen achteruit rijden"],
        correct: "Parkeren"
    }
];

function startSignsGame() {
    score = 0;
    signsIndex = 0;
    updateStats();
    feedback.textContent = "";
    loadSignsQuestion();
}

function loadSignsQuestion() {
    if (signsIndex >= signsQuestions.length) {
        saveGameScore(score, "signs");
        showEndScreen("🏁 Verkeersborden klaar!", `${score}/${signsQuestions.length}`);
        return;
    }

    const q = signsQuestions[signsIndex];
    memoryGame.innerHTML = `
        <div class="mini-game-box">
            <h3>Bord ${signsIndex + 1}</h3>
            <div class="sign-emoji">${q.emoji}</div>
            <p><strong>${q.sign}</strong></p>
            <p>${q.question}</p>
            <div id="signs-choices" class="choices"></div>
        </div>
    `;

    const choices = document.getElementById("signs-choices");
    q.choices.forEach(choice => {
        const btn = document.createElement("button");
        btn.textContent = choice;
        btn.onclick = () => {
            if (choice === q.correct) {
                score++;
                feedback.textContent = "✅ Goed!";
            } else {
                feedback.textContent = `❌ Fout. Goed antwoord: ${q.correct}`;
            }
            updateStats();
            signsIndex++;
            setTimeout(loadSignsQuestion, 1000);
        };
        choices.appendChild(btn);
    });
}

/* ======================
   EXTRA GAME 4: VOORRANG KIEZEN
====================== */
let priorityIndex = 0;

const priorityQuestions = [
    {
        situation: "Je komt bij een kruispunt zonder borden. Er komt iemand van rechts.",
        choices: ["Jij mag eerst", "Verkeer van rechts mag eerst", "Niemand mag rijden"],
        correct: "Verkeer van rechts mag eerst"
    },
    {
        situation: "Een voetganger staat klaar bij een zebrapad.",
        choices: ["Voetganger krijgt voorrang", "Auto rijdt altijd eerst", "Je hoeft niet op te letten"],
        correct: "Voetganger krijgt voorrang"
    },
    {
        situation: "Je wilt een rotonde oprijden en er rijdt al een auto op de rotonde.",
        choices: ["Auto op de rotonde mag eerst", "Jij mag altijd eerst", "Allebei tegelijk"],
        correct: "Auto op de rotonde mag eerst"
    },
    {
        situation: "Je ziet haaientanden op de weg voor jou.",
        choices: ["Voorrang geven", "Extra hard rijden", "Niet kijken"],
        correct: "Voorrang geven"
    },
    {
        situation: "Een ambulance komt eraan met sirene en zwaailicht.",
        choices: ["Ruimte maken", "Voor de ambulance blijven rijden", "Stoppen midden op de weg"],
        correct: "Ruimte maken"
    }
];

function startPriorityGame() {
    score = 0;
    priorityIndex = 0;
    updateStats();
    feedback.textContent = "";
    loadPriorityQuestion();
}

function loadPriorityQuestion() {
    if (priorityIndex >= priorityQuestions.length) {
        saveGameScore(score, "priority");
        showEndScreen("🏁 Voorrang game klaar!", `${score}/${priorityQuestions.length}`);
        return;
    }

    const q = priorityQuestions[priorityIndex];
    memoryGame.innerHTML = `
        <div class="mini-game-box priority-box">
            <h3>Situatie ${priorityIndex + 1}</h3>
            <p class="hazard-situation">${q.situation}</p>
            <div id="priority-choices" class="choices"></div>
        </div>
    `;

    const choices = document.getElementById("priority-choices");
    q.choices.forEach(choice => {
        const btn = document.createElement("button");
        btn.textContent = choice;
        btn.onclick = () => {
            if (choice === q.correct) {
                score++;
                feedback.textContent = "✅ Goed gekozen!";
            } else {
                feedback.textContent = `❌ Fout. Goed antwoord: ${q.correct}`;
            }
            updateStats();
            priorityIndex++;
            setTimeout(loadPriorityQuestion, 1000);
        };
        choices.appendChild(btn);
    });
}


/* ======================
   FIX: GAME CARDS KLIKBAAR MAKEN
   Hierdoor werken de game kaarten ook als onclick niet goed pakt.
====================== */
window.startGame = startGame;
window.restartGame = restartGame;
window.backToMenu = backToMenu;

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".game-card[data-game]").forEach(card => {
        card.style.cursor = "pointer";
        card.onclick = () => {
            const gameName = card.getAttribute("data-game");
            startGame(gameName);
            setTimeout(() => gameArea.scrollIntoView({ behavior: "smooth", block: "start" }), 50);
        };
    });
});
