<?php

/**
 * Robert Peña, 000738570
 * Selects price of item from items database based on the item id of the item
 * Takes parameters from script, and adds a new item to the cart_items database table
 * 
 * December 6 2019
 */
include "connect.php";
try {
    $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);
    $itemId = filter_input(INPUT_POST, "itemId", FILTER_VALIDATE_INT);
    $orderId = filter_input(INPUT_POST, "orderId", FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
    $userId = filter_input(INPUT_POST, "userId", FILTER_VALIDATE_INT);


    $cmd = "SELECT price from items where id = ?";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$itemId]);

    if ($success) {
        echo "success";
        while ($row = $stmt->fetch()) {
            $price = $row["price"];
        }
        $cost = $price * $quantity;
        $cmd = "INSERT into cart_items (item_id, order_id, quantity, cost) VALUE (?,?,?,?)";
        $stmt = $db->prepare(($cmd));
        $success = $stmt->execute([$itemId, $orderId, $quantity, $cost]);
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
