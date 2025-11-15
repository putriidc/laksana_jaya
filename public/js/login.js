const focusInput = document.getElementsByClassName("focus-input");
const togglePassword = document.getElementById("toggle");

togglePassword.addEventListener("click", function () {
    const passwordInput = document.getElementById("password");
    const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
    if (type === "password") {
        togglePassword.src = "/assets/eye.png";
    } else {
        togglePassword.src = "/assets/eye-slash.png";
    }
    passwordInput.setAttribute("type", type);
});

for (let i = 0; i < focusInput.length; i++) {
    focusInput[i].addEventListener("focus", function () {
        this.previousElementSibling.classList.add(
            "translate-y-[-22px]",
            "translate-x-[5px]",
            "bg-white",
            "px-2"
        );
    });
    focusInput[i].addEventListener("blur", function () {
        if (this.value === "") {
            this.previousElementSibling.classList.remove(
                "translate-y-[-22px]",
                "translate-x-[5px]",
                "bg-white",
                "px-2"
            );
        }
    });
}
