<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande Confirmée - KICKSTEP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/commandes.css">
</head>
<body>

    <div class="receipt-container">
        
        <div class="success-header">
            <i class="fas fa-check-circle icon-check"></i>
            <h1>Merci, Thomas !</h1>
            <p class="subtitle">Votre commande <span class="order-id">#ORD-9928</span> a bien été reçue.</p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3>Adresse de livraison</h3>
                <p>Thomas Anderson<br>
                12 rue de la Matrice<br>
                75001 Paris, France</p>
            </div>
            <div class="info-box">
                <h3>Mode de paiement</h3>
                <p><i class="fab fa-cc-visa"></i> Visa terminant par **4242</p>
            </div>
        </div>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th style="text-align:center;">Qté</th>
                    <th style="text-align:right;">Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="product-col">
                            <img src="https://via.placeholder.com/50" alt="Sneaker" class="thumb">
                            <div>
                                <span class="prod-name">Nike Air Jordan 1</span>
                                <span class="prod-size">Taille : 43</span>
                            </div>
                        </div>
                    </td>
                    <td style="text-align:center;">1</td>
                    <td style="text-align:right;">180,00 €</td>
                </tr>
            </tbody>
        </table>

        <div class="totals-section">
            <div class="total-row">
                <span>Sous-total</span>
                <span>204,00 €</span>
            </div>
            <div class="total-row">
                <span>Livraison</span>
                <span>Gratuite</span>
            </div>
            <div class="total-row final">
                <span>Total</span>
                <span>180,00 €</span>
            </div>
        </div>

        <a href="produits.php" class="btn-home">Continuer mes achats</a>
    </div>

</body>
</html>