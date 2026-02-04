<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Document</title>
</head>
<body>
    <footer class="site-footer">
    <div class="footer-container">
        <div class="footer-col">
          <div class="logo-link">
    <img src="../images/logo_ecommerce.png" 
          alt="Logo Kickstep" 
          style="height: 100px; width: auto; filter: invert(1); mix-blend-mode: screen;">
</div>
            <p class="footer-desc">
                La référence du style urbain. Qualité premium et designs exclusifs pour votre garde-robe.
            </p>
            <div class="social-links">
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
                <a href="#">Facebook</a>
            </div>
        </div>

        <div class="footer-col">
            <h3>Boutique</h3>
            <ul>
                <li><a href="#">Nouveautés</a></li>
                <li><a href="#">Promotions</a></li>
                <li><a href="#">Accessoires</a></li>
                <li><a href="#">Cartes Cadeaux</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Aide</h3>
            <ul>
                <li><a href="#">Suivre ma commande</a></li>
                <li><a href="#">Retours & Échanges</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Mentions Légales</a></li>
            </ul>
        </div>

        <div class="footer-col newsletter-col">
            <h3>Newsletter</h3>
            <p>Inscrivez-vous pour recevoir -10% sur votre première commande.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Votre email...">
                <button type="submit">OK</button>
            </form>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 SHOP. Tous droits réservés.</p>
        <p>Paiement sécurisé : Visa • MasterCard • PayPal</p>
    
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin"): ?>
            <a href="../pages/admin_dashboard.php" class="admin-link">Admin Access</a>
        <?php endif ?>
        </div>
</footer>
</body>
</html>