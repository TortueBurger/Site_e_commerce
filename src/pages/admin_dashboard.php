<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Liste des produits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>

    <div class="dashboard-header">
        <div>
            <h1>Admin Dashboard</h1>
            <span style="color:#666; font-size:0.9rem;">Gérez vos produits et stocks</span>
        </div>
        <div>
            <a href="../pages/admin_add.php" class="btn-add">+ Ajouter un produit</a>
            <a href="../pages/homepage.php" class="btn-logout">Déconnexion</a>
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
                
                <tr>
                    <td><img src="https://via.placeholder.com/60" class="thumb-img"></td>
                    <td>
                        <span class="product-name">Nike Air Jordan 1</span>
                        <span class="product-id">ID: #14</span>
                    </td>
                    <td>189.99 €</td>
                    <td><span class="stock-tag">12 en stock</span></td>
                    <td class="actions">
                        <a href="../pages/admin_edit.php" class="btn-action btn-edit"><i class="fas fa-pen"></i> Modifier</a>
                        <a href="#" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>

                <tr>
                    <td><img src="https://via.placeholder.com/60" class="thumb-img"></td>
                    <td>
                        <span class="product-name">Adidas Yeezy Boost</span>
                        <span class="product-id">ID: #15</span>
                    </td>
                    <td>220.00 €</td>
                    <td><span class="stock-tag low-stock">2 en stock !</span></td>
                    <td class="actions">
                        <a href="../pages/admin_edit.php" class="btn-action btn-edit"><i class="fas fa-pen"></i> Modifier</a>
                        <a href="#" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>

                <tr>
                    <td><img src="https://via.placeholder.com/60" class="thumb-img"></td>
                    <td>
                        <span class="product-name">Nike TN Plus</span>
                        <span class="product-id">ID: #16</span>
                    </td>
                    <td>170.00 €</td>
                    <td><span class="stock-tag">45 en stock</span></td>
                    <td class="actions">
                        <a href="../pages/admin_edit.php" class="btn-action btn-edit"><i class="fas fa-pen"></i> Modifier</a>
                        <a href="#" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</body>
</html>