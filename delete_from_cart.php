<?php

/**
 * Robert Peña, 000738570
 *
 * November 7 2019
 * Deletes row from database after receiving post parameters
 */
include "connect.php";

try {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $cmd = "DELETE from cart_items where order_item_id = ?";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$id]);
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
