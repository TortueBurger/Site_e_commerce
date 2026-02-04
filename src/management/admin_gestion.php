<?php
require_once('../config/config.php');
require_once('../management/order_gestion.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

$name = $brand = $price = $stock = '';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $brand = $_POST["brand"];
    $stock = $_POST["stock"];
    $price = $_POST["price"];

    if (isset($_GET["type"])){
        if ( (int) $_GET["type"] == 1 ){
            request_modification();
        } elseif ( (int) $_GET["type"] == 2 ){
            request_add();
        }
    }
}

function request_add(){
    global $name, $brand, $price, $stock;
    $image_url = upload_image("");
    add_item($name, $brand, $price, $image_url, $stock);
    header('Location: ../pages/admin_dashboard.php');
}

function request_modification(){
    if (isset($_GET["id"])){
        $id = (int) $_GET["id"];
        $item = get_item($id);

        $old_url = $item["image_url"];
        $image_url = upload_image($old_url);

        modify_item($item, $id, $image_url);
    }
}

function upload_image($old_url){
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $upload_dir = "../images/";
        $extention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid("img_").".".$extention;
        $destination = $upload_dir.$image_name;
        $allowed_type = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array(strtolower($extention), $allowed_type)){
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
                if (!empty($old_url) && file_exists($old_url)){
                    unlink($old_url);
                }
                return $destination;
            }
        }
    }
    return $old_url;
}

// Prepare the item for database modification
function modify_item($item, $id, $image_url){
    global $name, $brand, $price, $stock;
    update_item($id, $name, $brand, $price, $image_url, $stock);
    header('Location: ../pages/admin_dashboard.php');
}

//Gestion of items in the admin panel
function add_item($name, $brand, $price, $image_url, $quantity_in_stocks) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("INSERT INTO items (name, brand, price, image_url) VALUES (?, ?, ?, ?)");
    $statment->bind_param("ssds", $name, $brand, $price, $image_url);

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

function update_item($item_id, $name, $brand, $price, $image_url, $quantity_in_stocks) {
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("UPDATE items SET name = ?, brand = ?, price = ?, image_url = ? WHERE id = ?");
    $statment->bind_param("ssdsi", $name, $brand, $price, $image_url, $item_id);

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

    // Prepare and bind
    $statment = $connection->prepare("DELETE FROM stock WHERE item_id = ?");
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

