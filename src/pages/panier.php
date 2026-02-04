<?php

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Is loaded in ajax (prevent footer and header to repeat)
$ajax = isset($_GET["ajax"]);

require_once("../management/order_gestion.php");

// Get Orders with Session ID 
if (isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    // add_to_order($id, 1);

    if (isset($_GET["clear"]) && isset($_GET["clear"]) == 1){
        clear_order($id);
    }

    // Delete Item
    if (isset($_GET["del"]) && isset($_GET["amount"])){
        $count = (int) ($_GET["amount"]);
        $item_id = (int) $_GET["del"];
        $size = (int) $_GET["size"];
        $add = isset($_GET["type"]);
        while ($count > 0){
            if ($add){
                add_to_order($id, $item_id, $size);
            } else {
                remove_item_from_order($item_id, $id);
            }
            $count--;
        }
    }

    $orders = get_order_items($id);
    if (count($orders) == 1 && $orders[0] == ''){
        $orders = [];
    }
}


ob_start();
?>

<div id="content">
    <div id="cart-container">
        <link rel="stylesheet" href="../css/panier.css">
        <script src="../js/script.js"></script>
        <div class="cart-items">
            <h1>Votre Panier</h1>

            <?php 
            // Empty
            if (empty($orders)): ?>
                <div class="empty-cart">
                    <p>Votre panier est vide pour le moment.</p>
                    <a href="produits.php" class="btn-back">Retourner à la boutique</a>
                </div>
            <?php else: ?>
                
                <?php 
                // Display Orders and Checkout Card
                $total = 0;
                $seen = [];
                foreach ($orders as $item_id):
                    if (in_array($item_id, $seen) or $item_id == ''){
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
                            <div class="item-size">taille: <?= number_format($item['size']) ?> </div>
                        </div>

                        <div class="item-quantity">
                            <span>Qté:</span>
                            <button onclick="load_data_orders('del=<?= $item_id ?>&amount=1')">-</button>
                            <input type="text" value="<?= $quantity ?>" class="qty-input" readonly>
                            <button onclick="load_data_orders('del=<?= $item_id ?>&amount=1&type=1')">+</button>
                        </div>

                        <a href="#" onclick="load_data_orders('del=<?= $item_id ?>&amount=<?= $quantity ?>')" class="btn-remove">Supprimer</a>
                    </div>
                <?php 
                    endforeach; 
                ?>
                <a href=# class="btn-clear" onclick="load_data_orders('clear=1')">Vider le panier</a>

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
                <?php if ($total >= 200): ?>
                    <span>Gratuite</span>
                <?php else: ?>
                    <span>10.00 €</span>
            <?php endif; ?>
            </div>
            
            <div class="summary-total">
                <span>TOTAL</span>
                <span><?= number_format($total, 2) ?> €</span>
            </div>

            <a href="#" class="btn-checkout">Procéder au paiement</a>
            <div style="text-align:center; margin-top:10px;">
                <a href="produits.php" style="font-size:0.8rem; color:#666; text-decoration:none;">Continuer vos achats</a>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php 
// Fin du contenu et appel du layout principal
$content = ob_get_clean(); 

if ($ajax){
    echo $content;
} else{
    require('../templates/layout.php');
}

?>