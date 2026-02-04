<?php

// Create database and its tables
require_once('database/create_database.php');
require_once('database/create_tables.php');

// Redirect to Homepage
header('Location: pages/homepage.php');

// Terminate Script
exit();

?>