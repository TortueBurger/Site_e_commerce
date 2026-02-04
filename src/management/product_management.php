<?php

if (isset($is_main)){
    require_once('config/config.php');
} else{
    require_once('../config/config.php');
}

$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

//Return all items in database in a dictionary
function get_all_items_infos() {
    global $connection;
    $items = [];
    $sql = "SELECT items.id, items.name, items.brand, items.price, items.image_url, stock.quantity_in_stocks
            FROM items 
            JOIN stock ON items.id = stock.item_id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Chaque $row est ici un dictionnaire (ex: $row['name'])
            $items[] = $row;
    }
    return $items;
    }
}


function default_database(){
    global $connection;
    // Prepare and bind
    $statment = $connection->prepare("INSERT INTO items (name, brand, price, image_url) VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?);");

    $name = "Air Jordan 1 Retro OG";
    $brand = "Nike";
    $price = 129.99;
    $image_url = "../images/img1.jpg";

    $name2 = "Shox Black";
    $brand2 = "Nike";
    $price2 = 149.99;
    $image_url2 = "../images/img2.jpg";

    $name3 = "Nocta white";
    $brand3 = "Nike";
    $price3 = 134.99;
    $image_url3 = "../images/img3.jpg";
 

   

    $statment->bind_param("ssdsssdsssds", $name, $brand, $price, $image_url, 
        $name2, $brand2, $price2, $image_url2,
        $name3, $brand3, $price3, $image_url3,);

    if ($statment->execute()) {
        echo "Item inserted successfully.";
    } else {
        echo "Error inserting item: " . $connection->error;
    }

    $statment = $connection->prepare("INSERT INTO stock (item_id, quantity_in_stocks) VALUES (?, ?), (?, ?), (?, ?);");

    $idtem_id1 = 1;
    $quantity_in_stocks1 = 50;
    $idtem_id2 = 2;
    $quantity_in_stocks2 = 30;
    $idtem_id3 = 3;
    $quantity_in_stocks3 = 0;
    
    $statment->bind_param("ssssss", $idtem_id1, $quantity_in_stocks1, $idtem_id2, $quantity_in_stocks2, $idtem_id3, $quantity_in_stocks3);
    if ($statment->execute()) {
        echo "Stock inserted successfully.";
    } else {
        echo "Error inserting stock: " . $connection->error;
    }

    $password = password_hash("motdepasse", PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, role) 
    VALUES ('admin', 'admin@kickstep.com', '$password', 'admin')";
    
    if ($connection -> query($sql) == TRUE){
        return;
    } else{
        echo $connection -> error;
    }

}

function get_item_stock($item_id){
    global $connection;
    $sql = "SELECT quantity_in_stocks FROM stock WHERE item_id = '$item_id'";
    $result = mysqli_query($connection, $sql);
    // Result
    if (mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()){
            return $row["quantity_in_stocks"];
        }
    }
    return 0;

}

?>