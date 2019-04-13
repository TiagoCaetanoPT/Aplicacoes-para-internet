<?php
  session_start();
  $cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session: Cart</title>
</head>
<body>
    <h1>Session: Cart</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <p>This page will use a session variable to store a "Shopping Cart" (with fake product information)</p>
    <hr>
    <h3>Add to cart the product</h3>
    <a href="addcart.php?id=1">product 1</a> | 
    <a href="addcart.php?id=2">product 2</a> | 
    <a href="addcart.php?id=3">product 3</a> | 
    <a href="addcart.php?id=4">product 4</a> | 
    <a href="addcart.php?id=5">product 5</a> | 
    <a href="addcart.php?id=6">product 6</a> | 
    <a href="addcart.php?id=7">product 7</a> | 
    <a href="addcart.php?id=8">product 8</a> | 
    <a href="addcart.php?id=9">product 9</a> | 
    <a href="addcart.php?id=10">product 10</a> | 
    <h3>Shopping Cart</h3>
    <ul>
    <?php
    foreach ($cart as $id => $qtd) {
        echo "<li>$qtd x Produto $id (<a href='removecart.php?id=$id'>delete</a>)</li>";
    }
    ?>
    </ul>
</body>
</html>