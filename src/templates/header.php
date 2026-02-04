<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Kickstep - Sneakers Shop'; ?></title>
    <link rel="stylesheet" href="../css/header.css"> 
</head>
<body>
    <header>
        <div class="header-top">
            Livraison gratuite à partir de 200€ | Retours sous 30 jours
        </div>
        
        <div class="header-main">                
            <a href="../pages/homepage.php" style="text-decoration: none; display: flex; align-items: center; color: inherit;">
                <img src="../images/logo_ecommerce.png" 
                     alt="Logo Kickstep" 
                     class="logo-img"
                     style="height: 100px;">
                <span class="logo-text">KICKSTEP</span>            
            </a>

            <nav>
                <ul class="nav-main">
                    <li><a href="../pages/homepage.php" class="<?php echo basename($_SERVER['PHP_SELF']) == '../pages/homepage.php' ? 'active' : ''; ?>">Accueil</a></li>
                    <li><a href="../pages/products.php">Produits</a></li>
                    <li><a href="../pages/drop.php">Nouveautés</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <button 
                    class="icon-btn" 
                    title="Mon compte" 
                    data-logged-in="<?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>"
                    onclick="handleAccountRedirect(this)">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
                
                <a href="cart.php" class="icon-btn" title="Panier" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <script src="../js/handle_redirection.js"></script>
</body>
</html>