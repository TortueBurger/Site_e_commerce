function toggleUserMenu(event) {
    event.stopPropagation();
    const menu = document.getElementById("user-dropdown");
    menu.classList.toggle("active");
}

// Ferme le menu si on clique ailleurs sur la page
document.addEventListener("click", function(event) {
    const menu = document.getElementById("user-dropdown");
    const button = document.querySelector(".icon-btn");
    
    if (menu.classList.contains("active") && !menu.contains(event.target)) {
        menu.classList.remove("active");
    }
});