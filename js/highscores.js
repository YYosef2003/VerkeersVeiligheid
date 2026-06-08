const user = JSON.parse(localStorage.getItem("user"));

const myScoreBox = document.getElementById("my-score");
const leaderboardBox = document.getElementById("leaderboard");
const gameTitle = document.getElementById("current-game-title");
const tabs = document.querySelectorAll(".hs-tab");

const gameNames = {
    obstacle: "🚗 Obstakel Game",
    reaction: "⚡ Reactie Test",
    hazard: "⚠️ Gevaar Herkennen",
    signs: "🪧 Verkeersborden Raden",
    priority: "🚸 Voorrang Kiezen"
};

function loadHighscores(gameName = "obstacle") {
    if (gameTitle) gameTitle.textContent = gameNames[gameName] || gameName;

    tabs.forEach(tab => {
        tab.classList.toggle("active", tab.dataset.game === gameName);
    });

    if (myScoreBox) {
        if (user && user.id) {
            fetch(`backend/get_my_highscore.php?user_id=${user.id}&game_name=${gameName}`)
                .then(res => res.json())
                .then(data => {
                    myScoreBox.innerHTML = data.length
                        ? `<div class="score-row"><b>${escapeHtml(user.username)}</b> - ${data[0].score} punten</div>`
                        : "<p>Nog geen score gevonden voor deze game.</p>";
                })
                .catch(() => {
                    myScoreBox.innerHTML = "<p>Fout bij laden van jouw score.</p>";
                });
        } else {
            myScoreBox.innerHTML = "<p>Log in om jouw beste score te zien.</p>";
        }
    }

    if (leaderboardBox) {
        leaderboardBox.innerHTML = "<p>Scores laden...</p>";

        fetch(`backend/get_scores.php?game_name=${gameName}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    leaderboardBox.innerHTML = "<p>Geen highscores gevonden voor deze game.</p>";
                    return;
                }

                leaderboardBox.innerHTML = "";

                data.forEach((item, index) => {
                    leaderboardBox.innerHTML += `
                        <div class="score-row">
                            <b>#${index + 1}</b> ${escapeHtml(item.player_name)} - ${item.score} punten
                        </div>
                    `;
                });
            })
            .catch(err => {
                console.error(err);
                leaderboardBox.innerHTML = "<p>Fout bij laden scores.</p>";
            });
    }
}

function escapeHtml(text) {
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
        loadHighscores(tab.dataset.game);
    });
});

loadHighscores("obstacle");
