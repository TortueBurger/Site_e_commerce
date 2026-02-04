/**
 * Redirige l'utilisateur selon son état de connexion
 * @param {HTMLElement} button - Le bouton cliqué contenant l'attribut data-logged-in
 */
function handleAccountRedirect(button) {
    // On récupère la valeur de l'attribut data-logged-in
    const isLoggedIn = button.getAttribute('data-logged-in') === 'true';

    if (isLoggedIn) {
        window.location.href = "../pages/profile.php";
    } else {
        window.location.href = "../pages/login.php";
    }
}
