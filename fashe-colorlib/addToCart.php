<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';

//fantoccio
$product = array('product' => 3, 'quantity' => 1, 'color' => "OneColor", 'size' => "OneColor")

if(($_SESSION['userrole'] == 'g')) {
    $_SESSION['cart'][]  = $product;
}
else {
    $user = $_SESSION['username'];
    $product = $product['product'];
    $quantity = $product['quantity'];
    $color = $product['color'];
    $size = $product['size'];
    queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$user', '$product', '$quantity', '$color', '$size');");
}
