<?php 
ob_start();

// 1. NOTRE BASE DE DONNÉES DE 8 PRODUITS (Images locales)
$catalog = [
    // --- LES 4 PRODUITS DE L'ACCUEIL ---
    1 => [
        'marque' => 'Nike',
        'modele' => 'Air Max Red Edition',
        'prix' => 129.99,
        'img' => '../images/img1.jpg' // Image locale 1
    ],
    2 => [
        'marque' => 'Puma',
        'modele' => 'RS-X Tech Black',
        'prix' => 110.00,
        'img' => '../images/img2.jpg' // Image locale 2
    ],
    3 => [
        'marque' => 'New Balance',
        'modele' => '530 Retro White',
        'prix' => 120.00,
        'img' => '../images/img3.jpg' // Image locale 3
    ],
    4 => [
        'marque' => 'Vans',
        'modele' => 'Old Skool Classic',
        'prix' => 75.00,
        'img' => '../images/img4.jpg' // Image locale 4
    ],
    // --- LES 4 NOUVEAUX PRODUITS (À toi de mettre les images !) ---
    5 => [
        'marque' => 'Adidas',
        'modele' => 'Yeezy Boost Style',
        'prix' => 220.00,
        'img' => '../images/img5.jpg' // Tu dois créer cette image
    ],
    6 => [
        'marque' => 'Jordan',
        'modele' => 'Retro High OG',
        'prix' => 180.00,
        'img' => '../images/img6.jpg' // Tu dois créer cette image
    ],
    7 => [
        'marque' => 'Asics',
        'modele' => 'Gel-Lyte III Urban',
        'prix' => 135.00,
        'img' => '../images/img7.jpg' // Tu dois créer cette image
    ],
    8 => [
        'marque' => 'Reebok',
        'modele' => 'Club C 85 Vintage',
        'prix' => 95.00,
        'img' => '../images/img8.jpg' // Tu dois créer cette image
    ]
];
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
                    <img src="<?= $produit['img'] ?>" alt="<?= $produit['modele'] ?>" class="card-img-top">
                    
                    <div class="card-body">
                        <div class="product-brand"><?= $produit['marque'] ?></div>
                        <div class="product-title"><?= $produit['modele'] ?></div>
                        <div class="product-price"><?= number_format($produit['prix'], 2) ?> €</div>
                        
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
                            </select>

                            <button type="submit" class="btn-add-cart">
                                Ajouter au panier
                            </button>
                        </form>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>