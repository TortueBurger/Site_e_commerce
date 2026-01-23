<?php 
ob_start();
require_once('../database/create_database.php');
require_once('../database/create_tables.php');
require_once('../management/login_request.php');
?>
    <div class=main">
        <h2>Inscription</h2>
        <form action="../pages/login.php" method="POST">
            <label>Username :</label><br>
            <input type="text" name="username" maxlength="16" required><br><br>

            <label>Email :</label><br>
            <input type="email" name="email" required><br><br>

            <label>Password :</label><br>
            <input type="password" name="password" minlength="8" required><br><br>


            <button type="submit">Inscription</button>
        </form>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>