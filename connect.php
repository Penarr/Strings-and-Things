<?php

/**
 * Robert Peña, 000738570
 * Connect file that connects to the database
 * 
 * December 6 2019
 */
try {
    $db = new PDO(
        "mysql:host=localhost; dbname=000738570",
        "root",
        ""
    );
} catch (Exception $e) {
    die("Could not connect to database{$e->getMessage()}");
}
