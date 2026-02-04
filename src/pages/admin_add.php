<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit - Admin</title>
    <link rel="stylesheet" href="../css/admin_add.css">
</head>
<body>

    <div class="edit-container">
        <h2>Ajouter un nouveau produit</h2>

        <form>
            <div class="current-img">
                <img src="https://via.placeholder.com/300x200/333/fff?text=Sneaker+Preview" alt="Aperçu actuel">
                <span>Image actuelle</span>
            </div>

            <div class="form-group">
                <label>Nom du modèle</label>
                <input type="text" value="Nike Air Jordan 1 High" required>
            </div>

            <div class="row-2-cols">
                <div class="form-group">
                    <label>Prix (€)</label>
                    <input type="number" step="0.01" value="" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" value="0" required>
                </div>
            </div>

            <div class="form-group">
                <label>Changer l'image (Optionnel)</label>
                <input type="file">
            </div>

            <button type="submit" class="btn-save">Enregistrer les modifications</button>
            <a href="../pages/admin_dashboard.php" class="btn-cancel">Annuler et retour</a>
        </form>
    </div>

</body>
</html>