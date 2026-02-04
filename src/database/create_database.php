<?php
require_once('config/config.php');

// Create connection
$conn = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS e_commerce_database";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}


$conn->close();
?>