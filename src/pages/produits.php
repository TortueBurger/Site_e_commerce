<?php 
ob_start();

require_once '../management/product_management.php';
require_once '../management/order_gestion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id_produit']) && isset($_SESSION["id"])) {
    // Sécurisation de la donnée (on force un nombre entier)
    $id = $_SESSION["id"];
    $id_item = intval($_POST['id_produit']);
    
    // Exécution de ta fonction
   if (add_to_order($id, $id_item)) {
        echo "succès"; 
    } else {
        echo "échec";
    }
    exit; // INDISPENSABLE
}

$catalog = get_all_items_infos();
    
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../css/produits.css">

    <div class="page-header">
        <h1>Notre Collection</h1>
        <p>Découvrez nos <?= count($catalog) ?> modèles exclusifs du moment.</p>
    </div>

    <div class="products-container">
        <div class="products-grid">
            
            <?php foreach($catalog as $id => $produit): ?>
                
                <div class="product-card">
                    <img src="<?= $produit['image_url'] ?>" alt="<?= $produit['name'] ?>" class="card-img-top">
                    
                    <div class="card-body">
                        <div class="product-brand"><?= $produit['brand'] ?></div>
                        <div class="product-title"><?= $produit['name'] ?></div>
                        <div class="product-price"><?= number_format($produit['price'], 2) ?> €</div>
                        
                        <form action="panier.php" method="GET" class="product-form">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            
                            <select name="taille" class="size-selector" required>
                                <option value="" disabled selected>Choisir une taille</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>

                            </select>
                            <?php if ($produit['quantity_in_stocks'] > 0): ?>
                                <?php if (isset($_SESSION["id"])): ?>
                                    <button type="button" 
                                            class="btn-add-cart" 
                                            data-id="<?php echo $produit['id']; ?>" 
                                            onclick="envoyerAuPanier(this)">
                                        Ajouter au panier
                                    </button>
                                <?php else: ?>
                                    <button type="button" 
                                            class="btn-add-cart" 
                                            onclick="window.location.replace('login.php')">
                                        Se connecter
                                    </button>
                                <?php endif ?>
                            <?php else: ?>
                                <button type="submit" class="btn-add-cart btn-out-of-stock" disabled>
                                    Plus de Stock
                                </button>
                            <?php endif; ?>
                            
                        </form>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
    <div id="toast-notification">✅ Article ajouté au panier</div>
    <script src="../js/order.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>