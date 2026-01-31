<?php
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);


//Gestion of items in the admin panel
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

function delete_item($item_id) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("DELETE FROM items WHERE id = ?");
    $statment->bind_param("i", $item_id);

    if ($statment->execute()) {
        echo "Item deleted successfully.";
    } else {
        echo "Error deleting item: " . $connection->error;
    }
}


//Gestion of users in the admin panel
function get_users() {
    global $connection;
    $users = [];
    $statment = $connection->prepare("SELECT id, name, email, role FROM users");
    $statment->execute();
    $result = $statment->get_result();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    return $users;
}


function delete_user($user_id) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("DELETE FROM users WHERE id = ?");
    $statment->bind_param("i", $user_id);

    if ($statment->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $connection->error;
    }
}

// Disconnect from database
$connection -> close();