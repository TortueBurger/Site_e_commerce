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
            Livraison gratuite à partir de 50€ | Retours sous 30 jours
        </div>
        
        <div class="header-main">                
            <a href="accueil.php" style="text-decoration: none; display: flex; align-items: center; color: inherit;">
                <img src="../images/logo_ecommerce.png" 
                     alt="Logo Kickstep" 
                     class="logo-img"
                     style="height: 100px; width: auto; filter: invert(1); mix-blend-mode: screen;">
                <span class="logo-text">Kickstep</span>            
            </a>

            <nav>
                <ul class="nav-main">
                    <li><a href="accueil.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'accueil.php' ? 'active' : ''; ?>">Accueil</a></li>
                    <li><a href="produits.php">Produits</a></li>
                    <li><a href="nouveautes.php">Nouveautés</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <div class="search-bar">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Rechercher...">
                </div>
                
                    <button class="icon-btn" title="Mon compte" onclick='window.location.replace("../pages/login.php")'>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </button>
                
                <a href="panier.php" class="icon-btn" title="Panier" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    
                    <span class="cart-count">
                        <?php 
                        // On vérifie si la session contient un panier et on fait la somme des quantités
                        if(isset($_SESSION['panier'])) {
                            echo array_sum($_SESSION['panier']);
                        } else {
                            echo '0';
                        }
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </header>
</body>
</html>