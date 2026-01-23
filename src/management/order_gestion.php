<?php

function add_to_order($user_id, $item_id) {
    require_once '../pages/db.php';

    try {
        $sql = IF EXIST (SELECT 1 FROM orders WHERE user_id = $user_id) {
            UPDATE orders 
            SET List_items = CONCAT(List_items, ',', $item_id)
            WHERE user_id = $user_id;
        } ELSE {
            INSERT INTO orders (user_id, List_items) 
            VALUES (?, ?);
        };
    }
} 