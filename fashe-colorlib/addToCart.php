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

$quantity = $_POST['jqueryaiutamitu1'];
$color = $_POST['jqueryaiutamitu2'];
$size = $_POST['jqueryaiutamitu3'];
$product = $_POST['jqueryaiutamitu4'];

$query = "SELECT id FROM prodotto WHERE nome = '$product';"
$result = queryMysql($query);
$row = $result->fetch_row();
$pid = $row[0];

$user = $_SESSION['userid'];

queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$user', '$pid', '$quantity', '$color', '$size');");

