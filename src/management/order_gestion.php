<?php
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);
function add_to_order($user_id, $item_id) {
    global $connection;

    // 1. Check if an order already exists for this user
    $check_statment = $connection->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $check_statment->bind_param("i", $user_id);
    $check_statment->execute();
    $result = $check_statment->get_result();

    if ($result->num_rows > 0) {
        // 2. Row exists, so UPDATE it
        $row = $result->fetch_assoc();
        $new_list = $row['list_items'] . "," . $item_id;
        
        $update_statment = $connection->prepare("UPDATE orders SET list_items = ? WHERE user_id = ?");
        $update_statment->bind_param("si", $new_list, $user_id);
        $success = $update_statment->execute();
    } else {
        // 3. Row doesn't exist, so INSERT it
        $insert_statment = $connection->prepare("INSERT INTO orders (user_id, list_items) VALUES (?, ?)");
        $insert_statment->bind_param("is", $user_id, $item_id);
        $success = $insert_statment->execute();
    }

    if ($success) {
        echo "Item added to order successfully";
    } else {
        echo "Error: " . $connection->error;
    }
}

function proceed_to_order($user_id) {
    require_once '../pages/db.php';
    global $connection;
    $stmt = $connection->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Items in order: " . $row['list_items'];
        $amount =
        $stmt =  $connection->prepare("INSERT INTO invoice (user_id, amount, facturation_address, city, postal_code) VALUES (?, ?, ?, ?, ?)");
    } else {
        echo "No items in order.";
    }


}