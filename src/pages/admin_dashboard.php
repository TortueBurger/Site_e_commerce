<?php 

require("../management/admin_gestion.php");
require("../management/product_management.php");

if (isset($_GET["del"])){
    $item_id = (int) $_GET["del"];
    delete_item($item_id);
}

$items = get_all_items_infos();

?>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - Liste des produits</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="../css/admin_dashboard.css">
        <script src="../js/script.js"></script>
    </head>
<div id="content">
    <body>

        <div class="dashboard-header">
            <div>
                <h1>Admin Dashboard</h1>
                <span style="color:#666; font-size:0.9rem;">Gérez vos produits et stocks</span>
            </div>
            <div>
                <a href="../pages/admin_add.php" class="btn-add">+ Ajouter un produit</a>
                <a href="../pages/homepage.php" class="btn-logout">Quitter</a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><img src="<?= $item["image_url"] ?>" class="thumb-img"></td>
                            <td>
                                <span class="product-name"><?= $item["name"] ?></span>
                                <span class="product-id">ID: #<?= $item["id"] ?></span>
                            </td>
                            <td><?= $item["price"] ?> €</td>
                            <td><span class="stock-tag"><?= $item["quantity_in_stocks"] ?> en stock</span></td>
                            <td class="actions">
                                <a href="../pages/admin_edit.php?id=<?= $item["id"] ?>" class="btn-action btn-edit"><i class="fas fa-pen"></i> Modifier</a>
                                <a href="#" onclick='load_data_dashboard("del=<?= $item["id"] ?>")' class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?> 
                
                </tbody>
            </table>
        </div>

    </body>
</div>