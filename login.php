<!DOCTYPE html>
<!--Robert Peña, 000738570. Modified the template 
Main shop page. Checks if user is valid
Elements in body will change depending on if the user is logged-->

<head>
    <title>Strings&Things Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/string_style.css">
</head>
<?php
$users = [];
session_start();
include "php/connect.php";
include "php/user.php";
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

/**
 * Selects every user from the database
 */
try {
    $cmd = "SELECT * from users";
    $stmt = $db->prepare($cmd);
    $success = $stmt->execute();
    //Create an object array and fill it
    if ($success) {
        while ($row = $stmt->fetch()) {
            $user = new user($row["id"], $row["username"], $row["password"]);
            array_push($users, $user);
        }
    }
} catch (Exception $e) {
    die("Error: {$e->getMessage()}");
}
//If the fields are not empty
if ($username != "" && $password != "") {
    foreach ($users as $u) {
        
        if ($username == $u->getUsername() && password_verify($password, $u->getPassword())) { //If username save user Id to session
            $_SESSION["userId"] = $u->getId();
            
        } 
    }
} else { //Destroy session
    session_unset();
    session_destroy();
}
?>



<body>
    <?php
    /**
     * Creates menu for shopping cart if user is logged in
     */
    if (isset($_SESSION["userId"])) {
        ?>
        <h1>Strings&Things</h1>
        <div id="inventoryDiv">
            <h2>Items</h2>
            <ul id="inventoryList"></ul>
        </div>
        <div id="shoppingCart">
            <h2>Items in Cart</h2>
            <ul id="itemList"></ul>
            <b>Total:</b> <p id="totalPrice">$0.00</p>
            <p id="quantityError"></p>
            <a href="checkout.php"><input type="button" id="checkOutBtn" name="checkOutBtn" value="Checkout"></a>
        </div>
        <a href="logout.php"><input type="button" id="logoutBtn" name="logoutBtn" value="Logout"></a>
        <input type = hidden id = userIdInput value =<?php echo $_SESSION["userId"];?>>

    <?php
    }
    /** 
     * Provides menu back to the main menu if not logged in
     */
    else {
        ?>
        <nav><a href="index.html">Main Menu</a></nav>
        <h1>Strings&Things</h1>
        <h2>The credentials entered were not valid. Please try again.</h2>
    <?php
    } ?>


</body>

</html>