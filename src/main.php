<?php

// Create database and its tables
require_once('database/create_database.php');
require_once('database/create_tables.php');

// Create Default Data
$is_main = true;
require_once('management/product_management.php');
default_database();

// Redirect to Homepage with reset argument
header('Location: pages/homepage.php?main=1');

// Terminate Script
exit();

?>