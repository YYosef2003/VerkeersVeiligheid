function login() {
    const msg = document.getElementById("msg");
    if (msg) msg.textContent = "";

    const username = document.getElementById("username");
    const password = document.getElementById("password");

    if (!username || !password) {
        console.error("Username or password field not found");
        return;
    }

    fetch("backend/session_handler.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "login",
            username: username.value,
            password: password.value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("LOGIN:", data);

        if (data.success) {
            localStorage.setItem("user", JSON.stringify(data));
            setTimeout(function() {
                window.location.href = "game.php";
            }, 500);
        } else {
            if (msg) {
                msg.textContent = data.message || "Inloggen mislukt";
            }
        }
    })
    .catch(err => {
        console.error("Login error:", err);
        if (msg) {
            msg.textContent = "Kan geen verbinding maken met server";
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    const user = JSON.parse(localStorage.getItem("user") || "{}");
    const loggedUser = document.getElementById("logged-user");

    if (user && user.username) {
        if (loggedUser) {
            loggedUser.textContent = "Ingelogd als: " + user.username;
        }
    } else {
        if (loggedUser) {
            loggedUser.textContent = "Niet ingelogd";
        }
    }
});