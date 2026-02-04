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
    if (isset($_GET["del"]) && isset($_GET["amount"]) && isset($_GET["size"])){
        $count = (int) ($_GET["amount"]);
        $item_id = (int) $_GET["del"];
        $size = (int) $_GET["size"];
        $add = isset($_GET["type"]);
        while ($count > 0){
            if ($add){
                add_to_order($id, $item_id, $size);
            } else {
                remove_item_from_order($item_id, $id, $size);
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
        <link rel="stylesheet" href="../css/cart.css">
        <script src="../js/script.js"></script>
        <div class="cart-items">
            <h1>Votre Panier</h1>

            <?php 
            // Empty
            if (empty($orders)): ?>
                <div class="empty-cart">
                    <p>Votre panier est vide pour le moment.</p>
                    <a href="products.php" class="btn-back">Retourner à la boutique</a>
                </div>
            <?php else: ?>
                
                <?php 
                // Display Orders and Checkout Card
                $total = 0;
                $seen = [];
                foreach ($orders as $item):
                    $item_info = get_item($item['item_id']);
                    $quantity = $item['quantity'];
                    $total += $item_info["price"]*$quantity;
                ?>
                    <div class="cart-item">
                        <img src="<?= $item_info['image_url'] ?>" alt="<?= $item_info['name'] ?>">
                        
                        <div class="item-details">
                            <div class="item-title"><?= $item_info['name'] ?></div>
                            <div class="item-price"><?= number_format($item_info['price'], 2) ?> €</div>
                            <div class="item-size">taille: <?= number_format($item['size']) ?> </div>
                        </div>

                        <div class="item-quantity">
                            <span>Qté:</span>
                            <button onclick="load_data_orders('del=<?= $item['item_id'] ?>&amount=1&size=<?= $item['size'] ?>')">-</button>
                            <input type="text" value="<?= $quantity ?>" class="qty-input" readonly>
                            <button onclick="load_data_orders('del=<?= $item['item_id'] ?>&amount=1&type=1&size=<?= $item['size'] ?>')">+</button>
                        </div>

                        <a href="#" onclick="load_data_orders('del=<?= $item['item_id'] ?>&amount=<?= $quantity ?>&size=<?= $item['size'] ?>')" class="btn-remove">Supprimer</a>
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

            <form method="POST" action="commands.php">
                <input type="text" placeholder="Adresse complète..." name="address" required>
                
                <div class="row-address" style="display: flex; gap: 10px;">
                    <input type="text" placeholder="Ville..." name="city" style="flex: 2;" required>
                    <input type="text" placeholder="Code Postal..." name="zipcode" style="flex: 1;" required>
                </div>
                
                <button type="submit" class="btn-checkout">Procéder au paiement</button>
            </form>

            <div style="text-align:center; margin-top:10px;">
                <a href="products.php" style="font-size:0.8rem; color:#666; text-decoration:none;">Continuer vos achats</a>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php 
$content = ob_get_clean(); 

if ($ajax){
    echo $content;
} else{
    require('../templates/layout.php');
}

?>