<?php 
ob_start();

require_once '../management/product_management.php';
require_once '../management/order_gestion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id_produit'], $_POST['size']) && isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $id_item = intval($_POST['id_produit']);
    $size = intval($_POST['size']);
    
    $order = get_order_items($id);
    $stock = get_item_stock($id_item);
    $quantity = 0;

    foreach($order as $item){
        if($item["item_id"] == $id_item){
            $quantity = $item["quantity"];
        }
    }

    if (!($quantity >= $stock)){
        if (add_to_order($id, $id_item, $size)) {
            echo "success"; 
        } else {
            echo "failure";
        }
    }
    exit;
}

$catalog = get_all_items_infos();
    
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../css/products.css">
    
    <?php if(!empty($catalog)): ?>
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
                        
                        <form class="product-form">
                            <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                            
                            <select name="size" class="size-selector" required>
                                <option value="" disabled selected>Choisir une taille</option>
                                <?php for($i=38; $i<=48; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
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
    <?php else: ?>
        <div class="page-header">
        <h1>Notre Collection</h1>
        <p>Désolé ya pu.</p>
    </div>
    <div class="products-container" style="height:17vw;"></div>
    <?php endif ?>
    <div class="toast-notification" id="toast-add-to-order">✅ Article ajouté au panier</div>
    <div class="toast-notification" id="toast-select-size">❌ Veuillez choisir une taille</div>
    <script src="../js/order.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>