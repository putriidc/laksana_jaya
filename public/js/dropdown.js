// custome js
const dropdownToggles = document.getElementById("dropdown-toggle");

dropdownToggles.addEventListener("click", function () {
    const dropdownMenu = document.getElementById("dropdown-menu");
    const iconDropdown = document.getElementById("icon-dropdown");
    if (this.checked) {
        dropdownMenu.classList.remove("hidden");
        iconDropdown.classList.add("rotate-[-90deg]");
    } else {
        dropdownMenu.classList.add("hidden");
        iconDropdown.classList.remove("rotate-[-90deg]");
    }
});
