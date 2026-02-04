<?php
require_once('../config/config.php');
$connection = new mysqli(SERVER_NAME, SERVER_USERNAME, SERVER_PASSWORD, DB_NAME);

//Return all items in database in a dictionary
function get_all_items() {
    global $connection;
    $items = [];
    $sql = "SELECT items.id, items.name, items.brand, items.price, items.image_url
            FROM items ";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Chaque $row est ici un dictionnaire (ex: $row['name'])
            $items[] = $row;
    }
    return $items;
    }
}

?>