<!DOCTYPE html>
<!--Robert Peña, 000738570. Modified the template Dexember 6 2019 
Page that informs a user when they are logged out-->

<head>
    <title>Strings&Things Logout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/string_style.css">
</head>
<?php
session_start();
session_unset();
session_destroy();
?>

<body>
    <nav><a href="index.html">Main Menu</a><a href="registration.html">Registration</a></nav>
    <h1>Strings&Things</h1>
    <h2>Logout Successful</h2>
</body>