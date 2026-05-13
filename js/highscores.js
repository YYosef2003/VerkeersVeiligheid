const container = document.getElementById("scores");

fetch("backend/get_scores.php")
    .then(res => res.json())
    .then(data => {

        if (!data.length) {
            container.innerHTML = "Geen scores gevonden";
            return;
        }

        data.forEach((item, index) => {
            const div = document.createElement("div");

            div.innerHTML = `
                <b>#${index + 1}</b> 
                ${item.player_name} - ${item.score}
            `;

            container.appendChild(div);
        });

    })
    .catch(err => {
        console.error(err);
        container.innerHTML = "Fout bij laden scores";
    });