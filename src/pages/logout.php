<?php
session_start();
session_unset();
session_destroy();

// Redirect the user back to the home page or login page
header("Location: homepage.php");
exit();
?>