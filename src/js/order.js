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
    console.log("Réponse reçue :", message); // <--- AJOUTE ÇA POUR VOIR L'ERREUR DANS LA CONSOLE (F12)

    // On transforme tout en minuscules pour être sûr de trouver le mot
    const msg = message.toLowerCase();

    if (msg.includes("succès") || msg.includes("successfully") || msg.includes("item added")) {
        // Affiche le Toast noir
        const toast = document.getElementById("toast-notification");
        toast.classList.add("show");
        setTimeout(() => { toast.classList.remove("show"); }, 1500);
    } else {
        // Si le message est vide, on affiche une erreur par défaut
        alert(message || "Erreur inconnue lors de l'ajout");
    }
});
}