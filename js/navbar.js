document.addEventListener('DOMContentLoaded', function () {
    updateNavbar();

    const hamburgerBtn = document.getElementById('hamburger-btn');
    const navMenu = document.getElementById('nav-menu');

    if (hamburgerBtn && navMenu) {
        hamburgerBtn.addEventListener('click', function () {
            navMenu.classList.toggle('open');
            hamburgerBtn.classList.toggle('open');
        });
    }
});

function updateNavbar() {
    const user = localStorage.getItem('user');
    const loggedUserSpan = document.getElementById('logged-user');
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const logoutBtn = document.getElementById('logout-btn');
    const profileLink = document.getElementById('profile-link');

    if (user) {
        try {
            const userData = JSON.parse(user);

            if (loggedUserSpan) {
                loggedUserSpan.textContent = '👤 ' + userData.username;
                loggedUserSpan.style.display = 'inline';
            }

            if (loginBtn) loginBtn.style.display = 'none';
            if (registerBtn) registerBtn.style.display = 'none';
            if (logoutBtn) logoutBtn.style.display = 'inline-block';
            if (profileLink) profileLink.style.display = 'inline-block';

        } catch (e) {
            console.error('Error parsing user data', e);
            clearUser();
        }
    } else {
        if (loggedUserSpan) loggedUserSpan.style.display = 'none';
        if (loginBtn) loginBtn.style.display = 'inline-block';
        if (registerBtn) registerBtn.style.display = 'inline-block';
        if (logoutBtn) logoutBtn.style.display = 'none';
        if (profileLink) profileLink.style.display = 'none';
    }
}

let logoutInProgress = false;

function logout() {
    if (logoutInProgress) return;
    logoutInProgress = true;

    localStorage.removeItem('user');

    fetch('backend/session_handler.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'logout' }),
        credentials: 'same-origin'
    })
    .then(res => res.json())
    .then(data => {
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 200);
    })
    .catch(err => {
        console.error('Logout error:', err);

        setTimeout(() => {
            window.location.href = 'index.php';
        }, 200);
    });
}

function clearUser() {
    localStorage.removeItem('user');
    updateNavbar();
}