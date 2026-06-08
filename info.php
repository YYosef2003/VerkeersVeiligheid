<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkeersveiligheid | Informatie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<main class="content">

    
    <section class="info-hero">
        <div class="emoji-bg small">
            <span>🚗</span>
            <span>🚲</span>
            <span>🛴</span>
            <span>🚦</span>
            <span>⚠️</span>
        </div>

        <h2>Waarom is verkeersveiligheid belangrijk?</h2>
        <p>
            Elke dag gaan miljoenen mensen de weg op. Eén moment van afleiding kan
            grote gevolgen hebben. Verkeersveiligheid zorgt ervoor dat jij én
            anderen veilig thuiskomen.
        </p>
        <p>
            Vooral jongeren lopen extra risico door afleiding, groepsdruk en smartphones.
            Daarom is bewust en verantwoordelijk gedrag superbelangrijk.
        </p>
    </section>

    
    <section class="info-grid">

        <div class="info-card clickable-info" onclick="window.location.href='fietsers.php'">
            <h3>🚲 Fietsers & E-steps</h3>
            <ul>
                <li>💡 Goede verlichting voor en achter</li>
                <li>📵 Geen telefoon tijdens het rijden</li>
                <li>🖐️ Altijd richting aangeven</li>
                <li>🌧️ Rustiger bij regen of gladheid</li>
                <li>🎧 Maximaal één oortje</li>
                <li>⚠️ Let op voetgangers en auto's bij kruispunten</li>
            </ul>
        </div>

        <div class="info-card clickable-info" onclick="window.location.href='voetgangers.php'">
            <h3>🚶 Voetgangers</h3>
            <ul>
                <li>👀 Kijk links, rechts, links</li>
                <li>🚦 Gebruik zebrapaden en lichten</li>
                <li>📱 Telefoon weg bij oversteken</li>
                <li>🌙 Reflectie in het donker</li>
                <li>⚡ Wees alert bij fietsers en elektrische steps</li>
            </ul>
        </div>

        <div class="info-card clickable-info" onclick="window.location.href='automobilisten.php'">
            <h3>🚗 Automobilisten</h3>
            <ul>
                <li>⏱️ Houd je aan de snelheid</li>
                <li>🚲 Extra opletten bij fietsers</li>
                <li>🛑 Stop voor zebrapaden</li>
                <li>📵 Geen telefoon achter het stuur</li>
                <li>🌧️ Pas snelheid aan bij slecht weer</li>
            </ul>
        </div>

        <div class="info-card clickable-info" onclick="window.location.href='afleiding.php'">
            <h3>📱 Afleiding & social media</h3>
            <ul>
                <li>❌ Appen of scrollen tijdens verkeer is levensgevaarlijk</li>
                <li>⚡ Let op vrienden en groepsdruk op de weg</li>
                <li>✅ Stop veilig als je echt iets moet checken</li>
            </ul>
        </div>

        <div class="info-card clickable-info" onclick="window.location.href='zichtbaarheid.php'">
            <h3>🌙 Zichtbaarheid</h3>
            <ul>
                <li>💡 Reflecterende kleding dragen in het donker</li>
                <li>🚨 Zorg dat je goed zichtbaar bent voor automobilisten</li>
                <li>🛴 Voor steps en fietsen: verlichting altijd aan</li>
            </ul>
        </div>

        <div class="info-card clickable-info" onclick="window.location.href='gevaarlijke-situaties.php'">
            <h3>⚠️ Gevaarlijke situaties</h3>
            <ul>
                <li>🚧 Let op wegwerkzaamheden</li>
                <li>💨 Pas snelheid aan bij regen, sneeuw of gladheid</li>
                <li>👫 Let extra op op drukke plekken zoals scholen</li>
            </ul>
        </div>

    </section>

    <section id="info-detail" class="info-detail" style="display:none;">
        <h2 id="info-detail-title"></h2>
        <p id="info-detail-text"></p>
        <ul id="info-detail-list"></ul>
        <button class="back-btn" onclick="closeInfoDetail()">Sluiten</button>
    </section>

    <section class="warning">
        <h3>📱 Telefoon & verkeer</h3>
        <p>
            Appen, scrollen of filmen in het verkeer is één van de grootste
            oorzaken van ongelukken.
        </p>

        <ul>
            <li>❌ Appen tijdens fietsen of rijden</li>
            <li>❌ Filmen voor social media</li>
            <li>✅ Stop veilig als je echt moet bellen</li>
            <li>⚠️ Afleiding kan levens kosten – blijf alert!</li>
        </ul>
    </section>

    
    <section class="cta">
        <h2>Leer het spelenderwijs 🎮</h2>
        <p>
            Test hoe goed jij verkeerssituaties inschat met onze interactieve games.
            Hoe beter je scoort, hoe veiliger jij wordt.
        </p>
        <a href="game.php" class="button">🚦 Naar de games</a>
    </section>

</main>

<footer>
    <p>© 2026 Verkeersveiligheid | Stay safe ✨</p>
</footer>

<script>
const infoDetails = {
    fiets: {
        title: "🚲 Fietsers & E-steps",
        text: "Als fietser of stepper ben je kwetsbaar, omdat auto's jou soms te laat zien. Daarom moet je goed zichtbaar zijn en voorspelbaar rijden.",
        points: ["Gebruik altijd verlichting in het donker.", "Geef richting aan met je hand.", "Gebruik geen telefoon tijdens het rijden.", "Rem eerder bij regen of gladheid."]
    },
    voetganger: {
        title: "🚶 Voetgangers",
        text: "Voetgangers hebben vaak voorrang op een zebrapad, maar je moet altijd blijven kijken of verkeer echt stopt.",
        points: ["Kijk links, rechts en nog een keer links.", "Steek niet over terwijl je op je telefoon kijkt.", "Gebruik een zebrapad of verkeerslicht.", "Draag iets lichts of reflecterend in het donker."]
    },
    auto: {
        title: "🚗 Automobilisten",
        text: "Automobilisten moeten extra opletten bij scholen, kruispunten, fietsers en voetgangers. Snelheid bepaalt hoe hard een botsing aankomt.",
        points: ["Houd afstand.", "Stop voor zebrapaden.", "Kijk goed in je spiegels.", "Rijd langzamer bij slecht weer of drukte."]
    },
    afleiding: {
        title: "📱 Afleiding & social media",
        text: "Een paar seconden naar je telefoon kijken kan al genoeg zijn om een gevaarlijke situatie te missen.",
        points: ["Leg je telefoon weg voordat je vertrekt.", "Film niet tijdens het fietsen of rijden.", "Laat je niet opjutten door vrienden.", "Stop veilig als je echt moet bellen."]
    },
    zichtbaarheid: {
        title: "🌙 Zichtbaarheid",
        text: "In het donker of bij regen zien bestuurders jou veel minder goed. Verlichting en reflectie maken daarom veel verschil.",
        points: ["Zet fietsverlichting aan.", "Draag reflecterende kleding of tas.", "Controleer of je lampen werken.", "Blijf op goed verlichte routes als dat kan."]
    },
    gevaar: {
        title: "⚠️ Gevaarlijke situaties",
        text: "Bij scholen, kruispunten en wegwerkzaamheden verandert het verkeer snel. Daar moet je extra opletten.",
        points: ["Rijd rustiger bij drukke plekken.", "Let op onverwachte bewegingen van anderen.", "Houd rekening met regen, sneeuw of gladheid.", "Kijk vooruit en maak op tijd ruimte."]
    }
};

function showInfoDetail(type) {
    const detail = infoDetails[type];
    if (!detail) return;
    document.getElementById("info-detail-title").textContent = detail.title;
    document.getElementById("info-detail-text").textContent = detail.text;
    document.getElementById("info-detail-list").innerHTML = detail.points.map(point => `<li>${point}</li>`).join("");
    document.getElementById("info-detail").style.display = "block";
    document.getElementById("info-detail").scrollIntoView({ behavior: "smooth" });
}

function closeInfoDetail() {
    document.getElementById("info-detail").style.display = "none";
}
</script>
</body>
</html>
