<!DOCTYPE html>
<!--Robert Peña, 000738570. Modified the template December 6 2019
Displays total of order to user-->

<head>
    <title>Strings&Things Logout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/checkout.js"></script>
    <link rel="stylesheet" type="text/css" href="css/string_style.css">
</head>
<?php
session_start();

?>

<body>
    <nav><a href="index.html">Main Menu</a><a href="registration.html">Registration</a></nav>
    <h1>Strings&Things</h1>
    <?php
    if(isset($_SESSION["userId"])){ ?>
    <h2>Checked out</h2>
    <div id="orderSummary">
        <h3 id="orderDetails"></h3>
        <p id="noItemsInOrder"></p>
    </div>
    <input type = hidden id = userIdInput value =<?php echo $_SESSION["userId"];?>>

    <?php
    }
    else{
        ?>

        <h2>Access denied</h2>
        <?php
    }
    ?>
</body>
<?php
session_unset();
session_destroy();
?>

</html>