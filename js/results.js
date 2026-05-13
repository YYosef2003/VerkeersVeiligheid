const user = JSON.parse(localStorage.getItem("user"));
const container = document.getElementById("results");

if (!user || !user.id) {
    container.innerHTML = "<p>Je bent niet ingelogd.</p>";
} else {
    fetch(`backend/get_quiz_results.php?user_id=${user.id}`)
        .then(res => res.json())
        .then(data => {
            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = "<p>Geen resultaten gevonden.</p>";
                return;
            }

            container.innerHTML = "";

            data.forEach(item => {
                const div = document.createElement("div");
                div.style.background = "white";
                div.style.padding = "15px";
                div.style.margin = "10px 0";
                div.style.borderRadius = "12px";
                div.style.boxShadow = "0 5px 15px rgba(0,0,0,0.1)";

                div.innerHTML = `
                    <b>Vraag:</b> ${item.question}<br>
                    <b>Jouw antwoord:</b> ${item.given_answer}<br>
                    <b>Correct antwoord:</b> ${item.correct_answer}<br>
                    <b>Resultaat:</b> ${item.is_correct == 1 ? "✅ Goed" : "❌ Fout"}<br>
                    <b>Score op dat moment:</b> ${item.score}
                `;

                container.appendChild(div);
            });
        })
        .catch(err => {
            console.error(err);
            container.innerHTML = "<p>Fout bij laden van resultaten.</p>";
        });
}