<?php
require_once('../config/config.php');


// Create connection
$conn = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(256) NOT NULL,
role ENUM('admin', 'client') DEFAULT 'client'
);

CREATE TABLE IF NOT EXISTS items (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
brand VARCHAR(30) NOT NULL,
price DECIMAL(10,2) NOT NULL,
image_url VARCHAR(100) NOT NULL,
date_publication DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(6) UNSIGNED NOT NULL,
list_items TEXT NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS invoice (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(6) UNSIGNED NOT NULL,
transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
amount DECIMAL(10,2) NOT NULL,
facturation_address VARCHAR(100) NOT NULL,
city VARCHAR(50) NOT NULL,
postal_code VARCHAR(10) NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS stock (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
item_id INT(6) UNSIGNED NOT NULL,
quantity_in_stocks INT(6) NOT NULL,
FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE
);";

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