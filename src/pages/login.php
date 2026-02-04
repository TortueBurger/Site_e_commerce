<?php 
ob_start();
require_once('../management/login_request.php');

// Email Already used error
$mail_error = false;
if (isset($_GET["error"]) && $_GET["error"] == 1){
    $input_error = true;
}

// Show message Email/Password is incorrect
function show_error_message(){
    global $input_error;
    if ($input_error){
        echo "<span style='color:red'>Email/mot de passe incorrect</span>";
    }
}

?>
    
    <link rel="stylesheet" href="../css/login.css">
    <div class="main">
    <div class="content">
        <div class="card-center">
            <h2>Se Connecter</h2>
            
            <form action="../pages/login.php" method="POST" class="login-form">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Adresse e-mail..." required>
                    <?php show_error_message(); ?>
                </div>

                <div class="input-group">
                    <input type="password" name="password" minlength="8" placeholder="Mot de passe..." required>
                    <?php show_error_message(); ?>
                </div>

                <button type="submit" class="send">Se Connecter</button>
                
                <div class="footer-links">
                    <span>Pas encore de compte ?</span>
                    <a href="register.php">S'inscrire</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>