<?php 
ob_start();

require_once '../management/product_management.php';
require_once '../management/order_gestion.php';


if (isset($_SESSION["id"])){
    $id = $_SESSION["id"];
}


if (isset($_POST['id_produit'])) {
    // Sécurisation de la donnée (on force un nombre entier)
    $id_item = intval($_POST['id_produit']);
    
    // Exécution de ta fonction
   if (add_to_order(1, $id_item)) {
        echo "succès"; 
    } else {
        echo "échec";
    }
    exit; // INDISPENSABLE
}

$catalog = get_all_items_infos();
    // --- LES 8 PRODUITS DE L'ACCUEIL ---
    /*
    1 => [
        'marque' => 'Nike',
        'modele' => 'Air Max Blue Edition',
        'prix' => 129.99,
        'img' => '../images/img1.jpg' 
    ],
    2 => [
        'marque' => 'Nike',
        'modele' => 'Shox Black',
        'prix' => 170.00,
        'img' => '../images/img2.jpg' 
    ],
    3 => [
        'marque' => 'Nike',
        'modele' => 'Nocta White',
        'prix' => 220.00,
        'img' => '../images/img3.jpg' 
    ],
    4 => [
        'marque' => 'nike',
        'modele' => 'Mind',
        'prix' => 120.00,
        'img' => '../images/img4.jpg' 
    ],
    5 => [
        'marque' => 'nike',
        'modele' => 'cactus jack',
        'prix' => 300.00,
        'img' => '../images/img5.jpg' 
    ],
    6 => [
        'marque' => 'Jordan',
        'modele' => 'Jordan 4 Retro Red Thunder',
        'prix' => 180.00,
        'img' => '../images/img6.jpg' 
    ],
    7 => [
        'marque' => 'Nike',
        'modele' => 'Tuned 1 rose ',
        'prix' => 185.00,
        'img' => '../images/img7.jpg' 
    ],
    8 => [
        'marque' => 'Adidas',
        'modele' => 'Yeezy Boost 350',
        'prix' => 150.00,
        'img' => '../images/img8.jpg' 
    ]
        */

?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="../css/produits.css">

    <div class="page-header">
        <h1>Notre Collection</h1>
        <p>Découvrez nos 8 modèles exclusifs du moment.</p>
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
                                <button type="button" 
                                        class="btn-add-cart" 
                                        data-id="<?php echo $produit['id']; ?>" 
                                        onclick="envoyerAuPanier(this)">
                                    Ajouter au panier
                                </button>
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