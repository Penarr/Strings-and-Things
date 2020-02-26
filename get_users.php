<?php

/**
 * Robert Peña, 000738570
 * Selects all rows from the users database table.
 * Send a json encoded array that has every row stored.
 * 
 * December 6, 2019
 */
include "connect.php";
include "user.php";
$username = filter_input(INPUT_POST, "username", $filter = FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
try {
    $cmd = "SELECT * from users";
    $stmt = $db->prepare($cmd);
    $success = $stmt->execute();
    //Create an object array and fill it
    if ($success) {
        $users = [];
        while ($row = $stmt->fetch()) {
            $user = new user($row["id"], $row["username"], $row["password"]);
            array_push($users, $user);
        }

        echo json_encode($users);
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
