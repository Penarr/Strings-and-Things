<?php

/**
 * Robert Peña, 000738570
 *
 * Creates a new order for a user.
 * December 6 2019
 * 
 */
include "connect.php";
include "order.php";
$userId = filter_input(INPUT_POST, "userId", FILTER_VALIDATE_INT);

try {
    $cmd = "INSERT into orders (user_id) VALUE (?)";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$userId]);
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
