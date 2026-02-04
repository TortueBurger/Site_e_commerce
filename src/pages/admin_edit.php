<?php 

require('../management/order_gestion.php');
require('../management/product_management.php');

if (isset($_GET["id"])){
    $id = (int) $_GET["id"];
    $item = get_item($id);
    $stock = get_item_stock($id);
} else{
    header('Location: admin_dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit - Admin</title>
    <link rel="stylesheet" href="../css/admin_edit.css">
</head>
<body>

    <div class="edit-container">
        <h2>Modifier l'article</h2>

        <form method="POST" enctype="multipart/form-data" action="../management/admin_gestion.php?id=<?= $id ?>&type=1">
            <div class="current-img">
                <img src="<?= $item["image_url"] ?>" alt="Aperçu actuel">
                <span>Image actuelle</span>
            </div>

            <div class="form-group">
                <label>Marque</label>
                <input type="text" value="<?= $item["brand"] ?>" name="brand" required>
            </div>

            <div class="form-group">
                <label>Nom du modèle</label>
                <input type="text" value="<?= $item["name"] ?>" name="name" required>
            </div>

            <div class="row-2-cols">
                <div class="form-group">
                    <label>Prix (€)</label>
                    <input type="number" step="0.01" value="<?= $item["price"] ?>" name="price" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" value="<?= $stock ?>" name="stock" required>
                </div>
            </div>

            <div class="form-group">
                <label>Changer l'image (Optionnel)</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn-save">Enregistrer les modifications</button>
            <a href="../pages/admin_dashboard.php" class="btn-cancel">Annuler</a>
        </form>
    </div>

</body>
</html>