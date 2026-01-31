<?php 
ob_start();
require_once('../database/create_database.php');
require_once('../database/create_tables.php');
require_once('../management/order_gestion.php');
require_once('../management/register_request.php');

if (isset($_SESSION["name"])){
    echo $_SESSION["name"];
}

// Email Already used error
$mail_error = false;
if (isset($_GET["error"]) && $_GET["error"] == 1){
    $input_error = true;
}

function show_error_message(){
    global $input_error;
    if ($input_error){
        echo "<span style='color:red'>Email/mot de passe incorrect</span>";
    }
}


?>
    <div class="main">
        <h2>Inscription</h2>
        <form action="../pages/login.php" method="POST">
            <label>Username :</label><br>
            <input type="text" name="username" maxlength="16" required><br><br>

            <label>Email :</label><br>
            <input type="email" name="email" required><br>
            <?php show_error_message() ?>
            <br>

            <label>Password :</label><br>
            <input type="password" name="password" minlength="8" required><br>
            <?php show_error_message() ?>
            <br>

            <a href="register.php">Pas encore de compte ? Cliquez ici !</a><br>
            <button type="submit">Connexion</button>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>