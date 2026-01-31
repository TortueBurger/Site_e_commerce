<?php
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

function add_item($name, $marque, $description, $price, $image_url, $quantity_in_stocks) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("INSERT INTO items (name, marque, description, price, image_url) VALUES (?, ?, ?, ?, ?)");
    $statment->bind_param("ssdss", $name, $marque, $description, $price, $image_url);

    if ($statment->execute()) {
        $item_id = $statment->insert_id;

        // Now insert into stock table
        $stock_statment = $connection->prepare("INSERT INTO stock (item_id, quantity_in_stocks) VALUES (?, ?)");
        $stock_statment->bind_param("ii", $item_id, $quantity_in_stocks);
        if ($stock_statment->execute()) {
            echo "New item added successfully with stock.";
        } else {
            echo "Error adding stock: " . $connection->error;
        }
    } else {
        echo "Error adding item: " . $connection->error;
    }
}

function update_item($item_id, $name, $marque, $description, $price, $image_url, $quantity_in_stocks) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("UPDATE items SET name = ?, marque = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
    $statment->bind_param("ssdssi", $name, $marque, $description, $price, $image_url, $item_id);

    if ($statment->execute()) {
        // Now update stock table
        $stock_statment = $connection->prepare("UPDATE stock SET quantity_in_stocks = ? WHERE item_id = ?");
        $stock_statment->bind_param("ii", $quantity_in_stocks, $item_id);
        if ($stock_statment->execute()) {
            echo "Item and stock updated successfully.";
        } else {
            echo "Error updating stock: " . $connection->error;
        }
    } else {
        echo "Error updating item: " . $connection->error;
    }
}