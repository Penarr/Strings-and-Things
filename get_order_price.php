<?php

/**
 * Robert Peña, 000738570
 *
 * Takes order id from script.
 * Send total price of order to script
 * December 6 2019
 * 
 */
include "connect.php";
include "order.php";
try {

    $orderId = filter_input(INPUT_POST, "orderId", FILTER_VALIDATE_INT);
    $cmd = "SELECT * from cart_items where order_id = ?";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$orderId]);
    if ($success) {

        $totalPrice = 0.00;
        while ($row = $stmt->fetch()) {
            $totalPrice += (float) $row["cost"];
        }


        echo $totalPrice;
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
