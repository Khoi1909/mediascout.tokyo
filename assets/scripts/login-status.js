document.addEventListener("DOMContentLoaded", function () {
    let isLoggedIn = sessionStorage.getItem("isLoggedIn");

    const loginOption = document.getElementById("loginOption");
    const logoutOption = document.getElementById("logoutOption");

    if (isLoggedIn === "true") {
        if (loginOption) {
            loginOption.style.display = "none";
        }
        if (logoutOption) {
            logoutOption.style.display = "block";
        }
        document.body.classList.add("logged-in");
    } else {
        if (loginOption) {
            loginOption.style.display = "block";
        }
        if (logoutOption) {
            logoutOption.style.display = "none";
        }
    }
});