<?php
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

function add_to_order($user_id, $item_id, $size) {
    global $connection;

    // look for an order for the user 
    $check_order = $connection->prepare("SELECT id FROM orders WHERE user_id = ? LIMIT 1");
    $check_order->bind_param("i", $user_id);
    $check_order->execute();
    $res_order = $check_order->get_result();

    // if not exist create one
    if ($res_order->num_rows > 0) {
        $order_id = $res_order->fetch_assoc()['id'];
    } else {
        $create_order = $connection->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $create_order->bind_param("i", $user_id);
        $create_order->execute();
        $order_id = $connection->insert_id;
    }

    // check if the item is already in the order with the same size
    $check_item = $connection->prepare("SELECT id FROM order_items WHERE order_id = ? AND item_id = ? AND size = ?");
    $check_item->bind_param("iii", $order_id, $item_id, $size);
    $check_item->execute();
    $res_item = $check_item->get_result();

    if ($res_item->num_rows > 0) {
        // incrase quantity if the item already exist in the order with the same size
        $item_row = $res_item->fetch_assoc();
        $order_item_id = $item_row['id'];
        
        $update_qty = $connection->prepare("UPDATE order_items SET quantity = quantity + 1 WHERE id = ?");
        $update_qty->bind_param("i", $order_item_id);
        $success = $update_qty->execute();
    } else {
        // item not in order, insert it with quantity 1
        $insert_item = $connection->prepare("INSERT INTO order_items (order_id, item_id, size, quantity) VALUES (?, ?, ?, 1)");
        $insert_item->bind_param("iii", $order_id, $item_id, $size);
        $success = $insert_item->execute();
    }

    return $success;
}

// Return a list with all the items id of a user
function get_order_items($user_id) {
    global $connection;

    // with join to get all items with their sizes and quantities
    $query = "
        SELECT oi.item_id, oi.size, oi.quantity 
        FROM order_items oi
        JOIN orders o ON oi.order_id = o.id
        WHERE o.user_id = ?
    ";

    $statement = $connection->prepare($query);
    $statement->bind_param("i", $user_id);
    $statement->execute();
    $result = $statement->get_result();

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row; 
        // each $row is like: ['item_id' => 1, 'size' => 42, 'quantity' => 2]
    }
    return $items;
}

function get_total_amount($user_id) {
    global $connection;

    // we calculate the total by summing the price of each item multiplied by its quantity
    $query = "
        SELECT SUM(i.price * oi.quantity) as total 
        FROM order_items oi
        JOIN orders o ON oi.order_id = o.id
        JOIN items i ON oi.item_id = i.id
        WHERE o.user_id = ?
    ";

    $statement = $connection->prepare($query);
    $statement->bind_param("i", $user_id);
    $statement->execute();
    $result = $statement->get_result();

    if ($row = $result->fetch_assoc()) {
        // if there are items in the order, return the total, otherwise return 0
        return $row['total'] ?? 0;
    }

    return 0;
}

function clear_order($user_id) {
    global $connection;

    // Get the order ID for the user
    $get_order = $connection->prepare("SELECT id FROM orders WHERE user_id = ?");
    $get_order->bind_param("i", $user_id);
    $get_order->execute();
    $result = $get_order->get_result();

    if ($row = $result->fetch_assoc()) {
        $order_id = $row['id'];

        // delete all items in the order
        $delete_items = $connection->prepare("DELETE FROM order_items WHERE order_id = ?");
        $delete_items->bind_param("i", $order_id);
        $delete_items->execute();

        // delete the order itself
        $delete_order = $connection->prepare("DELETE FROM orders WHERE id = ?");
        $delete_order->bind_param("i", $order_id);
        $delete_order->execute();
    }
}

function proceed_order($user_id, $amount, $facturation_address, $city, $postal_code) {
    global $connection;

    // check if the user has items in the order
    $check_stmt = $connection->prepare("
        SELECT o.id 
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        WHERE o.user_id = ?
        LIMIT 1
    ");
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        //create an invoice for the order
        $invoice_stmt = $connection->prepare("
            INSERT INTO invoice (user_id, amount, facturation_address, city, postal_code) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $invoice_stmt->bind_param("idsss", $user_id, $amount, $facturation_address, $city, $postal_code);
        
        if ($invoice_stmt->execute()) {
            echo "Facture générée avec succès.";
            $order_items = get_order_items($user_id);
            // clear the order after proceeding and update the stock
            foreach ($order_items as $item) {
                update_stock($item['item_id'], -$item['quantity']);
            }
            clear_order($user_id);
        } else {
            echo "Erreur lors de la création de la facture : " . $connection->error;
        }
    } else {
        echo "Impossible de procéder : le panier est vide.";
    }
}

// Get item data from database
function get_item($item_id) {
    global $connection;
    
    $item = array();
    
    // 1. Utilisation d'une requête préparée pour la sécurité
    $stmt = $connection->prepare("SELECT name, brand, price, image_url FROM items WHERE id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 2. On récupère directement le tableau associatif
        $item = $result->fetch_assoc();
    }
    
    return $item;
}

function remove_from_all_orders($item_id) {
    global $connection;

    // delete the item from all order_items
    $statement = $connection->prepare("DELETE FROM order_items WHERE item_id = ?");
    $statement->bind_param("i", $item_id);
    $success = $statement->execute();
    return $success;
}

function remove_item_from_order($item_id, $user_id, $size) {
    global $connection;

    // 1. On récupère la quantité actuelle
    $query = "
        SELECT oi.id, oi.quantity FROM order_items oi
        JOIN orders o ON oi.order_id = o.id
        WHERE o.user_id = ? AND oi.item_id = ? AND oi.size = ?";
    
    $statement = $connection->prepare($query);
    $statement->bind_param("iii", $user_id, $item_id, $size);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 0) {
        return false;
    }

    $row = $result->fetch_assoc();
    $order_item_id = $row['id']; // Utiliser l'ID direct est plus rapide pour la suite

    if ($row['quantity'] <= 1) {
        // 2. Si c'est le dernier exemplaire, on SUPPRIME la ligne
        // Plus besoin de JOIN ici, on a l'ID précis de la ligne order_items
        $query_delete = "DELETE FROM order_items WHERE id = ? AND size = ?";
        $delete_stmt = $connection->prepare($query_delete);
        $delete_stmt->bind_param("ii", $order_item_id, $size);
        $success = $delete_stmt->execute();
    } else {
        // 3. Sinon, on diminue la QUANTITÉ de 1
        $query_update = "UPDATE order_items SET quantity = quantity - 1 WHERE id = ? AND size = ?";
        $update_stmt = $connection->prepare($query_update);
        $update_stmt->bind_param("ii", $order_item_id, $size);
        $success = $update_stmt->execute();
    }

    return $success;
}

function update_stock($item_id, $quantity_change) {
    global $connection;

    // update the stock for the item and size
    $stmt = $connection->prepare("UPDATE stock SET quantity = quantity + ? WHERE item_id = ?");
    $stmt->bind_param("ii", $quantity_change, $item_id);
    $success = $stmt->execute();

    return $success;
}

function get_user($user_id) {
    global $connection;
    $item = array();
    $sql = "SELECT id, name, email, role
            FROM users 
            WHERE id = '$user_id'";
    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $item = array(
            "id" => $row["id"],
            "name" => $row["name"],
            "email" => $row["email"],
            "role" => $row["role"]
        );
    }
    return $item;
}

function get_order_id($user_id) {
    global $connection;

    $stmt = $connection->prepare("SELECT id FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['id'];
    }

    return null;
}