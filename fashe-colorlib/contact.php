<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['userid'])){
    if(isset($_COOKIE['userid'])){
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        $_SESSION['username'] = 'Guest';
        $_SESSION['userrole'] = 'g';
    } 
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//TODO aggiungere controllo sui valori inseriti (js), per ora c'è solo il required.

//if (!$phone.is_int())

//Retrieve form data
if (isset($_REQUEST['name']) && isset($_REQUEST['phone-number']) && isset($_REQUEST['email']) && isset($_REQUEST['message'])) {
    $name = sanitizeString($_REQUEST['name']);
    $phone = sanitizeString($_REQUEST['phone-number']);
    $email = sanitizeString($_REQUEST['email']);
    $text = sanitizeString($_REQUEST['message']);
    queryMysql("INSERT INTO messaggi (nome, numero, email, messaggio) VALUES ('$name', '$phone', '$email', '$text');");
}

$smarty->display('contact.html');