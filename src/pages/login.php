<?php ob_start(); ?>
    <div class=main">
        <h2>Inscription</h2>
        <form action="../management/login_request.php" method="POST">
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
<?php require('layout.php') ?>