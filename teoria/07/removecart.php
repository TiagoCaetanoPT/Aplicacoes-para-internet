<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$id_remove = $_GET['id'] ?? '';
if (!empty($id_remove)) {
    unset($cart[$id_remove]);
    $_SESSION['cart'] = $cart;
}
header("Location: session_cart.php");
