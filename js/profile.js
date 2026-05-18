function register() {
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    fetch("backend/register.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "register",
            username: username,
            email: email,
            password: password
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log("SERVER:", data);

        if (data.success) {
            alert("Account aangemaakt!");
            localStorage.removeItem("user");
            window.location.href = "login.php";
        } else {
            alert(data.message || "Registreren mislukt");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Er ging iets mis");
    });
}