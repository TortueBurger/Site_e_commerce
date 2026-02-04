// AJAX Panier
function load_data_orders(extra) {
    // Debug
    const url = '../pages/cart.php?ajax=1&' + extra;
    console.log("URL envoyée au serveur :", url);
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Erreur:', error));
}

// AJAX Dashbaord Admin
function load_data_dashboard(extra) {
    // Debug
    const url = '../pages/admin_dashboard.php?' + extra;
    console.log("URL envoyée au serveur :", url);
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Erreur:', error));
}

// AJAX Dashbaord Admin User
function load_data_users(extra) {
    // Debug
    const url = '../pages/admin_users.php?' + extra;
    console.log("URL envoyée au serveur :", url);
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Erreur:', error));
}