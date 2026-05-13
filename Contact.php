<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkeersveiligheid | Contact</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Extra styling speciaal voor contact pagina */
        .contact-hero {
            position: relative;
            padding: 80px 20px;
            text-align: center;
            background: linear-gradient(135deg, #00b3ff, #00ffcc);
            color: #111;
            border-radius: 25px;
            overflow: hidden;
            margin: 30px auto;
            max-width: 900px;
        }

        .contact-hero h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .contact-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 25px auto;
        }

        form.contact-form {
            background: white;
            padding: 30px;
            border-radius: 25px;
            max-width: 700px;
            margin: 0 auto 50px auto;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        form.contact-form label {
            display: block;
            margin: 15px 0 5px 0;
            font-weight: 600;
        }

        form.contact-form input,
        form.contact-form textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 15px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 16px;
        }

        form.contact-form button {
            padding: 14px 30px;
            background: #111;
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        form.contact-form button:hover {
            background: #000;
            transform: scale(1.05);
        }

        .emoji-bg-contact {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .emoji-bg-contact span {
            position: absolute;
            font-size: 2.5rem;
            opacity: 0.15;
            animation: floatUp 18s linear infinite;
        }

        .emoji-bg-contact span:nth-child(1) { left: 10%; animation-delay: 0s; }
        .emoji-bg-contact span:nth-child(2) { left: 30%; animation-delay: 4s; }
        .emoji-bg-contact span:nth-child(3) { left: 55%; animation-delay: 8s; }
        .emoji-bg-contact span:nth-child(4) { left: 75%; animation-delay: 2s; }
        .emoji-bg-contact span:nth-child(5) { left: 90%; animation-delay: 6s; }

        @keyframes floatUp {
            from { transform: translateY(100%); }
            to { transform: translateY(-120%); }
        }
    </style>
</head>
<body>

<header>
    <h1>📬 Contact</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="info.html">Verkeersveiligheid</a>
        <a href="game.html">Game</a>
        <a href="contact.html" class="active">Contact</a>
        <a href="Over-ons.html" class="active">Over Ons</a>
        <a href="login.html" class="login-btn">Login</a>
    </nav>
</header>

<main class="content">

    <!-- HERO -->
    <section class="contact-hero">
        <div class="emoji-bg-contact">
            <span>📱</span>
            <span>🚦</span>
            <span>🚗</span>
            <span>🚲</span>
            <span>⚠️</span>
            <span>🛑</span>
        </div>
        <h2>Stuur ons een bericht! ✉️</h2>
        <p>
            Heb je vragen, suggesties of wil je iets melden over verkeersveiligheid?
            Vul onderstaand formulier in en wij reageren zo snel mogelijk!
        </p>
    </section>

    <!-- CONTACT FORM -->
    <form class="contact-form" onsubmit="return submitContactForm(event)">
        <label for="name">Naam 👤</label>
        <input type="text" id="name" name="name" placeholder="Jouw naam" required>

        <label for="email">Email 📧</label>
        <input type="email" id="email" name="email" placeholder="Jouw emailadres" required>

        <label for="subject">Onderwerp 📝</label>
        <input type="text" id="subject" name="subject" placeholder="Onderwerp" required>

        <label for="message">Bericht 💬</label>
        <textarea id="message" name="message" rows="6" placeholder="Typ hier je bericht..." required></textarea>

        <button type="submit">Verstuur ✨</button>
    </form>

</main>

<footer>
    <p>© 2026 Verkeersveiligheid | Blijf veilig 🚦</p>
</footer>

<script>
function submitContactForm(e){
    e.preventDefault();
    alert("✅ Bedankt! Je bericht is verzonden. We nemen snel contact op.");
    document.querySelector(".contact-form").reset();
}
</script>

</body>
</html>
