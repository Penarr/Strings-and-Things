<?php

/**
 * Robert Peña, 000738570
 *
 * Selects a currently opened order from a user
 * 
 * December 6 2019
 * 
 */
include "connect.php";
include "order.php";
$userId = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_NUMBER_INT);
try {

    $cmd = "SELECT * from orders where user_id = ? and ordered = ?";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$userId, 0]);

    if ($success) {
        $orders = [];
        while ($row = $stmt->fetch()) {
            $order = new order($row["order_id"], $row["user_id"], $row["price"], $row["ordered"]);
            array_push($orders, $order);
        }

        echo json_encode($orders);
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
