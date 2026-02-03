<?php
// On démarre la session pour stocker le panier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("../management/order_gestion.php");

// -------------------------------------------------------------------
// 1. FAUSSE BASE DE DONNÉES (Pour simuler tes produits)
// -------------------------------------------------------------------
$products_db = [
    1 => [
        'name' => 'Air Max Blue Edition',
        'price' => 129.99,
        'img' => '../images/img1.jpg'
    ],
    2 => [
        'name' => 'Nike Shox Black',
        'price' => 170.00,
        'img' => '../images/img2.jpg'
    ],
    3 => [
        'name' => 'Air Jordan High',
        'price' => 180.00,
        'img' => 'https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ],
    4 => [
        'name' => 'Vans Old Skool',
        'price' => 75.00,
        'img' => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60'
    ]
];

// -------------------------------------------------------------------
// 2. TRAITEMENT : AJOUT AU PANIER
// -------------------------------------------------------------------


// Get Session ID 
if (isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    // add_to_order($id, 1);
    $orders = get_order_items($id);
    $stats = array_count_values($orders);
}


// -------------------------------------------------------------------
// 3. TRAITEMENT : SUPPRIMER UN ARTICLE
// -------------------------------------------------------------------
// if (isset($_GET['del'])) {
//     $id_del = (int)$_GET['del'];
//     unset($_SESSION['panier'][$id_del]);
//     header('Location: panier.php');
//     exit();
// }

// Début du buffer pour le template layout
ob_start();
?>

<link rel="stylesheet" href="../css/panier.css">

<div class="cart-container">
    
    <div class="cart-items">
        <h1>Votre Panier</h1>

        <?php 
        // Si le panier est vide ou n'existe pas
        if (empty($orders)): ?>
            <div class="empty-cart">
                <p>Votre panier est vide pour le moment.</p>
                <a href="accueil.php" class="btn-back">Retourner à la boutique</a>
            </div>
        <?php else: ?>
            
            <?php 
            $total = 0;
            $seen = [];
            foreach ($orders as $item_id):
                if (in_array($item_id, $seen)){
                    continue;
                }
                $item = get_item($item_id);
                $seen[] = $item_id;
                $i = array_keys($orders, $item_id);
                $quantity = count($i);
                $total += $item["price"]*$quantity;
            ?>
                <div class="cart-item">
                    <img src="<?= $item['image_url'] ?>" alt="<?= $item['name'] ?>">
                    
                    <div class="item-details">
                        <div class="item-title"><?= $item['name'] ?></div>
                        <div class="item-price"><?= number_format($item['price'], 2) ?> €</div>
                    </div>

                    <div class="item-quantity">
                        <span>Qté:</span>
                        <input type="text" value="<?= $quantity ?>" class="qty-input" readonly>
                    </div>

                    <a href="panier.php?del=<?= $id ?>" class="btn-remove">Supprimer</a>
                </div>
            <?php 
                endforeach; 
            ?>

        <?php endif; ?>
    </div>

    <?php if (!empty($orders)): ?>
    <div class="cart-summary">
        <div class="summary-title">Résumé</div>
        
        <div class="summary-row">
            <span>Sous-total</span>
            <span><?= number_format($total, 2) ?> €</span>
        </div>
        <div class="summary-row">
            <span>Livraison</span>
            <span>Gratuite</span>
        </div>
        
        <div class="summary-total">
            <span>TOTAL</span>
            <span><?= number_format($total, 2) ?> €</span>
        </div>

        <a href="#" class="btn-checkout">Procéder au paiement</a>
        <div style="text-align:center; margin-top:10px;">
            <a href="homepage.php" style="font-size:0.8rem; color:#666; text-decoration:none;">Continuer vos achats</a>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php 
// Fin du contenu et appel du layout principal
$content = ob_get_clean(); 
require('../templates/layout.php'); 
?>