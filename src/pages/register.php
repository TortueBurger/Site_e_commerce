<?php 
ob_start();
require_once('../management/register_request.php');

if (isset($_SESSION["name"])){
    echo $_SESSION["name"];
}

// Email Already used error
$mail_error = false;
if (isset($_GET["error"]) && $_GET["error"] == 1){
    $mail_error = true;
}

function show_mail_error_message(){
    global $mail_error;
    if ($mail_error){
        echo "<span style='color:red;'>Email déjà utilisé/invalide.</span>";
    }
}

?>
    <link rel="stylesheet" href="../css/login.css">
    <div class="main">
    <div class="content">
        <div class="card-center">
            <h2>S'inscrire</h2>
            
            <form action="../pages/register.php" method="POST" class="login-form">
                <div class="input-group">
                    <input name="username" placeholder="Nom d'utilisateur" required>
                </div>
            
                <div class="input-group">
                    <input type="email" name="email" placeholder="Adresse e-mail..." required>
                    <?php show_mail_error_message(); ?>
                </div>

                <div class="input-group">
                    <input type="password" name="password" minlength="8" placeholder="Mot de passe..." required>
                </div>

                <button type="submit" class="send">S'inscrire</button>
                
                <div class="footer-links">
                    <span>Déjà inscrit ?</span>
                    <a href="login.php">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>