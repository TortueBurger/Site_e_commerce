<?php
require_once('../config/config.php');
$conn = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);
function add_to_order($user_id, $item_id) {
    global $conn;
    $sql = "SELECT list_items FROM orders WHERE user_id = $user_id";

    if ($sql) {
        $sql = "INSERT INTO orders (list_item) VALUES $item_id WHERE user_id = $user_id,
                ON DUPLICATE KEY UPDATE list_items = CONCAT(list_items, ',', $item_id)";
    } else {
        $sql = "INSERT INTO orders (user_id, list_items) VALUES ($user_id, $item_id)";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Item added to order successfully";
    } else {
        echo "Error adding item to order: " . $conn->error;
    }
}

function proceed_to_order($user_id) {
    require_once '../pages/db.php';

    


}