<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';

//Session management procedure
session_start();

if(isset($_COOKIE['userid'])){
    $_SESSION['userid'] = $_COOKIE['userid'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['userrole'] = $_COOKIE['userrole'];
}

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Guest';
    $_SESSION['userrole'] = 'g';
}

$quantity = $_POST['quantity'];
$color = $_POST['color'];
$size = $_POST['size'];
$product = $_POST['product'];

$query = "SELECT id FROM prodotto WHERE nome = '$product';"
$result = queryMysql($query);
$row = $result->fetch_row();
$pid = $row[0];

$quantity += checkProduct($color, $size);

$user = $_SESSION['userid'];

queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$user', '$pid', '$quantity', '$color', '$size');");



function checkProduct($color, $size) {
    $query = "SELECT quantita, colore taglia FROM carrello WHERE cliente = '$userid' AND prodotto = $pid;"
    $result = queryMysql($query);

    if($result->num_rows > 0) {
        for ($j = 0; $j < $result->num_rows; ++$j) {
            $result->data_seek($j);
            $product = $result->fetch_row();
            if($color = $product[$j][1] && $size = $product[$j][2]) {
                return $product[$j][0];
            }
        }
    }

    return 0;
}