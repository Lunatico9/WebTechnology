<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
sessionManager();

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
if (isset($_POST['name']) && isset($_POST['phone-number']) && isset($_POST['email']) && isset($_POST['message'])) {
    $name = sanitizeString($_POST['name']);
    $phone = sanitizeString($_POST['phone-number']);
    $email = sanitizeString($_POST['email']);
    $text = sanitizeString($_POST['message']);
    queryMysql("INSERT INTO messaggi (nome, numero, email, messaggio) VALUES ('$name', '$phone', '$email', '$text');");
}

$smarty->display('html/contact.html');