let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

menu.addEventListener("click", function () {
    navbar.classList.toggle("active");
});

window.onscroll = () => {
    navbar.classList.remove("active");
}

const toggleModeButton = document.querySelector("#toggle-mode");
const body = document.body;

toggleModeButton.addEventListener("click", function () {
    body.classList.toggle("light-mode");
    body.classList.toggle("dark-mode");
});

const popup = document.getElementById("popup");
const closeBtn = document.getElementById("close-btn");

setTimeout(() => {
    popup.style.display = "block";
}, 3000);  

closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
});
