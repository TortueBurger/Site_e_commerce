<?php 
ob_start();

require_once '../database/create_database.php';
require_once '../database/create_tables.php';

session_start();

if (isset($_SESSION["name"])){
    echo "<br> Connected User: ".$_SESSION["name"];
}

?>


<?php $content = ob_get_clean(); ?>
<?php require('../templates/layout.php') ?>