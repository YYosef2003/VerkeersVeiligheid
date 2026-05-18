const user = JSON.parse(localStorage.getItem("user"));

const myScoreBox = document.getElementById("my-score");
const leaderboardBox = document.getElementById("leaderboard");

if (myScoreBox && user && user.id) {
    fetch(`backend/get_my_highscore.php?user_id=${user.id}`)
        .then(res => res.json())
        .then(data => {
            myScoreBox.innerHTML = data.length
                ? `<p><b>${user.username}</b>: ${data[0].score} punten</p>`
                : "<p>Nog geen score gevonden.</p>";
        });
}

if (leaderboardBox) {
    fetch("backend/get_scores.php")
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                leaderboardBox.innerHTML = "<p>Geen highscores gevonden.</p>";
                return;
            }

            leaderboardBox.innerHTML = "";

            data.forEach((item, index) => {
                leaderboardBox.innerHTML += `
                    <div style="background:white; padding:12px; margin:10px 0; border-radius:12px;">
                        <b>#${index + 1}</b> ${item.player_name} - ${item.score} punten
                    </div>
                `;
            });
        })
        .catch(err => {
            console.error(err);
            leaderboardBox.innerHTML = "<p>Fout bij laden scores.</p>";
        });
}