<?php

/**
 * Robert Peña, 000738570
 * Selects all rows from the items database table.
 * Send a json encoded array that has every row stored.
 * 
 * December 6, 2019
 */
include "connect.php";
include "item.php";

try {
    $cmd = "SELECT * from items";
    $stmt = $db->prepare($cmd);
    $success = $stmt->execute();
    //Create an object array and fill it
    if ($success) {
        $items = [];
        while ($row = $stmt->fetch()) {
            $item = new item($row["id"], $row["name"], $row["price"], $row["manufacturer"], $row["description"]);
            array_push($items, $item);
        }

        echo json_encode($items);
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
