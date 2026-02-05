<?php 
ob_start();
// Start Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ajax = isset($_GET["ajax"]);

if (isset($_SESSION["role"])){
    if ($_SESSION["role"] !== 'admin'){
        header('Location: homepage.php');
    }
} else{
    header('Location: homepage.php');
}

require('../management/admin_gestion.php');

// Delete Manager
if (isset($_GET["del"])){
    $id = (int) $_GET["del"];
    delete_user($id);
}

// Get all users
$users = get_users();

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_users.css">
    <script src="../js/script.js"></script>

</head>

<div id="content">
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
                        <?php if(!empty($users)): ?>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td>#<?= $user["id"] ?></td>
                                    <td>
                                        <div class="user-name"><?= $user["name"] ?></div>
                                    </td>
                                    <td class="user-email"><?= $user["email"] ?></td>
                                <?php if($user["role"] == 'admin'): ?>
                                    <td><span class="role-badge role-admin">Admin</span></td>
                                    <td></td>
                                <?php else: ?>
                                    <td><span class="role-badge role-client"><?= $user["role"] ?></span></td>
                                    <td>
                                        <a href="#" onclick='load_data_users("del=<?= $user["id"] ?>")' class="btn-delete">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </a>
                                    </td>
                                </tr>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</div>
</html>
<?php $content = ob_get_clean(); ?>
<?php 
if ($ajax){
    echo $content;
} else{
    require('../templates/layout.php');
} 
?>