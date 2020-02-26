<?php

/**
 * Robert Peña, 000738570
 *
 * December 6 2019
 * Takes post parameters from the user_requests.js file, then adds a new row to the users table
 * Hashes password before storig it in the database
 */
include "connect.php";

try {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $cmd = "INSERT into users (username, password) VALUE (?,?)";
    $stmt = $db->prepare(($cmd));
    $success = $stmt->execute([$username, $password]);

    if ($success)
        echo "success";
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
