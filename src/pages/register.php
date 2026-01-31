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
    <div class=main">
        <h2>Inscription</h2>
        <form action="register.php" method="POST">
            <label>Username :</label><br>
            <input type="text" name="username" maxlength="16" required><br><br>

            <label>Email :</label><br>
            <input type="email" name="email" required>
            <br><?php show_mail_error_message() ?><br>
            

            <label>Password :</label><br>
            <input type="password" name="password" minlength="8" required><br><br>

            <a href="login.php">Déjà inscrit ? Cliquez ici !</a><br>
            <button type="submit">Inscription</button>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>