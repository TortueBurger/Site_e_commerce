function load_data_orders(extra) {

    // Debug
    const url = '../pages/panier.php?ajax=1&' + extra;
    console.log("URL envoyée au serveur :", url);
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => console.error('Erreur:', error));
}