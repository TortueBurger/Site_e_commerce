<?php 
ob_start();

// Start Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["role"])){
    if ($_SESSION["role"] != 'admin'){
        header('Location: homepage.php');
    }
} else{
    header('Location: homepage.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit - Admin</title>
    <link rel="stylesheet" href="../css/admin_add.css">
</head>
<body>
<div id="content">
    <div class="edit-container">
        <h2>Ajouter un nouveau produit</h2>

        <form method="POST" enctype="multipart/form-data" action="../management/admin_gestion.php?type=2">
            <div class="current-img">
                <img src="" alt="Aperçu actuel">
                <span>Image actuelle</span>
            </div>

            <div class="form-group">
                <label>Marque</label>
                <input type="text" value="" name="brand" required>
            </div>

            <div class="form-group">
                <label>Nom du modèle</label>
                <input type="text" value="" name="name" required>
            </div>

            <div class="row-2-cols">
                <div class="form-group">
                    <label>Prix (€)</label>
                    <input type="number" step="0.01" name="price" value="" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" value="0"  name="stock" required>
                </div>
            </div>

            <div class="form-group">
                <label>Changer l'image (Optionnel)</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit" class="btn-save">Enregistrer les modifications</button>
            <a href="../pages/admin_dashboard.php" class="btn-cancel">Annuler et retour</a>
        </form>
    </div>
</div>
</body>
</html>
<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>