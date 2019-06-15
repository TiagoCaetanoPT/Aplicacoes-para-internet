<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$id_add = $_GET['id'] ?? '';
if (!empty($id_add)) {
    $qtd = $cart[$id_add] ?? 0;
    $cart[$id_add] = $qtd + 1 ;
    $_SESSION['cart'] = $cart;
}
header("Location: session_cart.php");
