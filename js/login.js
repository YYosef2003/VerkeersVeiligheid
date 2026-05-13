function login() {
    fetch("backend/login.php", {
        method: "POST",
        body: new URLSearchParams({
            username: document.getElementById("username").value,
            password: document.getElementById("password").value
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("LOGIN:", data);

        if (data.success) {
            localStorage.setItem("user", JSON.stringify(data));
            window.location.href = "game.html";
        } else {
            document.getElementById("login-error").textContent =
                data.message || "Inloggen mislukt";
        }
    });
}
const user = JSON.parse(localStorage.getItem("user"));

const loggedUser = document.getElementById("logged-user");

if (user && user.username) {
    loggedUser.textContent = "Ingelogd als: " + user.username;
} else {
    loggedUser.textContent = "Niet ingelogd";
}