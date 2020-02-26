<?php

/**
 * Robert Peña, 000738570
 * Selects all rows from the cart_items database table that have the corresponding order id.
 * Send a json encoded array that has every row stored.
 * 
 * December 6, 2019
 */
include "connect.php";
include "cart_item.php";
$orderId = filter_input(INPUT_POST, "orderId", FILTER_VALIDATE_INT);

try {
    $cmd = "SELECT * from cart_items where order_id = ?";
    $stmt = $db->prepare($cmd);
    $success = $stmt->execute([$orderId]);
    //Create an object array and fill it
    if ($success) {
        $cart = [];
        while ($row = $stmt->fetch()) {
            $item = new cart_item($row["order_item_id"], $row["item_id"], $row["order_id"], $row["quantity"], $row["cost"]);
            array_push($cart, $item);
        }

        echo json_encode($cart);
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
