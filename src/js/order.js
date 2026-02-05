function envoyerAuPanier(bouton) {
    const idProduit = bouton.getAttribute('data-id');
    const toast_add_to_order = document.getElementById("toast-add-to-order");
    const toast_select_size = document.getElementById("toast-select-size");

    const parentForm = bouton.closest('.product-form');
    const sizeSelect = parentForm ? parentForm.querySelector('select[name="size"]') : null;

    if (sizeSelect) {
        const selectedSize = sizeSelect.value;

        if (!selectedSize || selectedSize === "") {
            if (toast_select_size) {
                toast_select_size.classList.add("show");
                setTimeout(() => { toast_select_size.classList.remove("show"); }, 1500);
            }
            return;
        }

        fetch('products.php', { 
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id_produit=' + encodeURIComponent(idProduit) + '&size=' + encodeURIComponent(selectedSize)
        })
        .then(response => response.text())
        .then(message => {
            console.log("Réponse reçue :", message);
            const msg = message.toLowerCase();

            if (msg.includes("success") || msg.includes("successfully")) {
                if (toast_add_to_order) {
                    toast_add_to_order.classList.add("show");
                    setTimeout(() => { toast_add_to_order.classList.remove("show"); }, 1500);
                }
            } else {
                // alert(message || "Erreur inconnue lors de l'ajout");
            }
        })
        .catch(error => {
            console.error("Erreur Fetch :", error);
        });
    }
}