<script>
function login() {

    const msg = document.getElementById("msg");

    fetch("backend/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("SERVER RESPONSE:", data);

        if (data.id) {
            localStorage.setItem("user", JSON.stringify(data));
            window.location.href = "game.html";
        } else {
            if (data.error === "empty_fields") {
                msg.textContent = "Vul alle velden in";
            } else if (data.error === "login_failed") {
                msg.textContent = "Gebruikersnaam of wachtwoord klopt niet";
            } else {
                msg.textContent = "Er ging iets mis";
            }
        }
    })
    .catch(err => {
        console.error("FETCH ERROR:", err);
        msg.textContent = "Kan geen verbinding maken met server";
    });
}
</script>