<?php 
ob_start();
require_once('../management/admin_gestion.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = get_user($_SESSION['id']);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/profile.css">
<div id="content">
    <div class="profile-card">
        
        <div class="avatar-container">
            <i class="fas fa-user avatar-icon"></i>
        </div>
        
        <span class="role-badge">Membre <?= $user['role'] ?></span>

        <div class="info-group">
            <span class="label">Nom complet</span>
            <div class="value">
                <i class="far fa-id-card" style="color:#666;"></i> 
                <?= $user['name'] ?>
            </div>
        </div>

        <div class="info-group">
            <span class="label">Adresse Email</span>
            <div class="value">
                <i class="far fa-envelope" style="color:#666;"></i> 
                <?= $user['email'] ?>
            </div>
        </div>

        <a href="logout.php" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Se déconnecter
        </a>

        <a href="products.php" class="link-home">Retour à la boutique</a>

    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>
