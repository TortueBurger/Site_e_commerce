<?php
require_once('../config/config.php');
$conn = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);
function add_to_order($user_id, $item_id) {
    global $conn;

    // 1. Check if an order already exists for this user
    $check_stmt = $conn->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // 2. Row exists, so UPDATE it
        $row = $result->fetch_assoc();
        $new_list = $row['list_items'] . "," . $item_id;
        
        $update_stmt = $conn->prepare("UPDATE orders SET list_items = ? WHERE user_id = ?");
        $update_stmt->bind_param("si", $new_list, $user_id);
        $success = $update_stmt->execute();
    } else {
        // 3. Row doesn't exist, so INSERT it
        $insert_stmt = $conn->prepare("INSERT INTO orders (user_id, list_items) VALUES (?, ?)");
        $insert_stmt->bind_param("is", $user_id, $item_id);
        $success = $insert_stmt->execute();
    }

    if ($success) {
        echo "Item added to order successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

function proceed_to_order($user_id) {
    require_once '../pages/db.php';
    global $conn;
    $stmt = $conn->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Items in order: " . $row['list_items'];
        $amount = 
        $stmt =  $conn->prepare("INSERT INTO invoice (user_id, amount, facturation_address, city, postal_code) VALUES (?, ?, ?, ?, ?)");
    } else {
        echo "No items in order.";
    }


}