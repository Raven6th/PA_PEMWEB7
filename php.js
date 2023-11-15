const toggleThemeButton = document.querySelector("#toggle-theme");
const body = document.body;

toggleThemeButton.addEventListener("click", function () {
    if (body.classList.contains("dark-mode")) {
        body.classList.remove("dark-mode");
        toggleThemeButton.innerText = "Ganti Tema";
    } else {
        body.classList.add("dark-mode");
        toggleThemeButton.innerText = "Ganti Tema";
    }
});