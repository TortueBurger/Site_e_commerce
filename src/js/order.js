function envoyerAuPanier(bouton) {
    const idProduit = bouton.getAttribute('data-id');
    const toast = document.getElementById("toast-notification");

    fetch('produits.php', { 
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_produit=' + encodeURIComponent(idProduit)
    })
    .then(response => response.text())
    .then(message => {
        // On vérifie si le PHP a renvoyé un succès (à adapter selon ton message PHP)
        if (message.includes("successfully") || message.includes("succès")) {
            
            // On affiche la pop-up noire
            toast.className = "show";
            
            // On la retire après 3 secondes (correspond à l'animation CSS)
            setTimeout(function(){ 
                toast.className = toast.className.replace("show", ""); 
            }, 1500);

        } else {
            // En cas d'erreur (ex: non connecté), on peut garder une alerte ou un toast rouge
            alert(message);
        }
    });
}