<?php 
ob_start();
session_start();

if (isset($_SESSION["name"])){
    echo $_SESSION["name"];
}

?>


<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>