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
        
        $update_stmt = $connection->prepare("UPDATE orders SET list_items = ? WHERE user_id = ?");
        $update_stmt->bind_param("si", $new_list, $user_id);
        $success = $update_stmt->execute();
    } else {
        // 3. Row doesn't exist, so INSERT it
        $insert_stmt = $connection->prepare("INSERT INTO orders (user_id, list_items) VALUES (?, ?)");
        $insert_stmt->bind_param("is", $user_id, $item_id);
        $success = $insert_stmt->execute();
    }

    if ($success) {
        echo "Item added to order successfully";
    } else {
        echo "Error: " . $connection->error;
    }
}

function get_order_items($user_id) {
    global $connection;
    $statment = $connection->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $statment->bind_param("i", $user_id);
    $statment->execute();
    $result = $statment->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return explode(",", $row['list_items']);
    } else {
        return [];
    }
}

function get_amount($item_ids) {
    global $connection;
    $amount = 0;
    foreach ($item_ids as $item_id) {
        $statment = $connection->prepare("SELECT price FROM items WHERE id = ?");
        $statment->bind_param("i", $item_id);
        $statment->execute();
        $result = $statment->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $amount += $row['price'];
        }
    }
    return $amount;
}

function clear_order($user_id) {
    global $connection;
    $statment = $connection->prepare("DELETE FROM orders WHERE user_id = ?");
    $statment->bind_param("i", $user_id);
    $statment->execute();
}

function proceed_order($user_id, $amount, $facturation_address, $city, $postal_code) {
    global $connection;
    $statment = $connection->prepare("SELECT list_items FROM orders WHERE user_id = ?");
    $statment->bind_param("i", $user_id);
    $statment->execute();
    $result = $statment->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Items in order: " . $row['list_items'];
        $statment =  $connection->prepare("INSERT INTO invoice (user_id, amount, facturation_address, city, postal_code) VALUES (?, ?, ?, ?, ?)");
        $statment->bind_param("idsss", $user_id, $amount, $facturation_address, $city, $postal_code);
        $statment->execute();
    } else {
        echo "No items in order.";
    }
    clear_order($user_id);
}

function remove_from_all_orders($item_id) {
    global $connection;
    $statment = $connection->prepare("SELECT user_id, list_items FROM orders");
    $statment->execute();
    $result = $statment->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $items = explode(",", $row['list_items']);
        if (in_array($item_id, $items)) {
            $items = array_filter($items, function($id) use ($item_id) {
                return $id != $item_id;
            });
            $new_list = implode(",", $items);
            $update_stmt = $connection->prepare("UPDATE orders SET list_items = ? WHERE user_id = ?");
            $update_stmt->bind_param("si", $new_list, $user_id);
            $update_stmt->execute();
        }
    }
}

function remove_item_from_order($item_id, $user_id) {
    global $connection;
    $statment = $connection->prepare("SELECT user_id, list_items FROM orders WHERE user_id = ?");
    $statment->bind_param("i", $user_id);
    $statment->execute();
    $result = $statment->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $items = explode(",", $row['list_items']);
        foreach ($items as $key => $id) {
            if ($id == $item_id) {
                unset($items[$key]);
                $new_list = implode(",", $items);
                $update_stmt = $connection->prepare("UPDATE orders SET list_items = ? WHERE user_id = ?");
                $update_stmt->bind_param("si", $new_list, $user_id);
                $update_stmt->execute();
                break;
            }
        }
    }
}