<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "e_commerce_database";


// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
role ENUM('admin', 'client') DEFAULT 'client'
);

CREATE TABLE IF NOT EXISTS items (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
description TEXT NOT NULL,
price DECIMAL(10,2) NOT NULL,
stock INT(6) NOT NULL,
image_url VARCHAR(100) NOT NULL,
date_publication DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY (id) REFERENCES users(id),
LIST OF FOREIGN KEY (id) REFERENCES items(id)
);

CREATE TABLE IF NOT EXISTS invoice (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY (id) REFERENCES users(id),
transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
amount DECIMAL(10,2) NOT NULL,
facturation_address VARCHAR(100) NOT NULL,
city VARCHAR(50) NOT NULL,
postal_code VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS stock (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
FOREIGN KEY (id) REFERENCES items(id),
quantity_in_stocks INT(6) NOT NULL
)";

if ($conn->multi_query($sql)) {
    do {
        // On passe au résultat suivant
        if ($result = $conn->store_result()) {
            $result->free();
        }
        // Si on a encore des requêtes à traiter
    } while ($conn->next_result());
    
    echo "Traitement terminé. Vérifiez phpMyAdmin !";
} else {
    echo "Erreur dès la première requête : " . $conn->error;
}