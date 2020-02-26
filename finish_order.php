<?php

/**
 * Robert Peña, 000738570
 *
 * Takes order id and totalPrice from script.
 * Marks order as complete and adds the total price to it
 * December 6 2019
 * 
 */
include "connect.php";
$orderId = filter_input(INPUT_POST, "orderId", FILTER_VALIDATE_INT);
$totalPrice = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
try {
    $cmd = "UPDATE orders set ordered = ?, price = ? where order_id = ?";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([1, $totalPrice, $orderId]);
    if($success){
        echo $totalPrice;
    }
    
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
