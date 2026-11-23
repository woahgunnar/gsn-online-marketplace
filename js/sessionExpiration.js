let inactivityTimer;
const timeout = 15 * 60 * 1000;

function resetTimer() {

    clearTimeout(inactivityTimer);
    inactivityTimer = setTimeout(logout, timeout);

    fetch("backend/sessionExpiration.php", {
        method: "POST"
    });

}

function logout() {

    window.location.href = "backend/logout.php";
}


document.addEventListener("mousemove", resetTimer);
document.addEventListener("keydown", resetTimer);
document.addEventListener("click", resetTimer);
document.addEventListener("scroll", resetTimer);
document.addEventListener("touchstart", resetTimer);
resetTimer();