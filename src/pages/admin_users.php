<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_users.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <div>
                <h1>Utilisateurs</h1>
                <span style="color:#666; font-size:0.9rem;">Gérez les comptes clients</span>
            </div>
            <a href="../pages/admin_dashboard.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour Dashboard 
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div class="user-name">Admin Principal</div>
                        </td>
                        <td class="user-email">admin@kickstep.com</td>
                        <td><span class="role-badge role-admin">Admin</span></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>#24</td>
                        <td>
                            <div class="user-name">Thomas Anderson</div>
                        </td>
                        <td class="user-email">neo@matrix.com</td>
                        <td><span class="role-badge role-client">Client</span></td>
                        <td>
                            <a href="#" class="btn-delete">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>#25</td>
                        <td>
                            <div class="user-name">Sarah Connor</div>
                        </td>
                        <td class="user-email">sarah@skynet.net</td>
                        <td><span class="role-badge role-client">Client</span></td>
                        <td>
                            <a href="#" class="btn-delete">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>