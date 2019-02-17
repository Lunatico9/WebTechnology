<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';

//Session management procedure
session_start();

if(isset($_COOKIE['userid'])){
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['userrole'] = $_COOKIE['userrole'];
}

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Guest';
    $_SESSION['userrole'] = 'g';
}

$product = $_POST['productarray'];


$user = "1";
$product = $product[0];
$quantity = $product[1];
$color = $product[2];
$size = $product[3];
queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$user', '$product', '$quantity', '$color', '$size');");

