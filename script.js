const sidebar = document.querySelector(".side-bar");
const burgerIcon = document.getElementById("burger-icon");

burgerIcon.addEventListener("click", () => {
    sidebar.classList.toggle("side-bar-toggle");
});


const darkModeToggle = document.getElementById("dark-mode-toggle");
const body = document.body;

darkModeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-theme");
});