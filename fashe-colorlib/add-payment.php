<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';


//Session management procedure
session_start();

if(!isset($_SESSION['username'])) {
    if(isset($_COOKIE['userid'])) {
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        redirect("login.php");
    }
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//Controlla se è presente messaggio d'errore da mostrare
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $smarty->assign("error", "$error");
}
else {
    $error = 0;
    $smarty->assign("error", "$error");
}

//Retrieve form data
if(isset($_REQUEST['name']) && isset($_REQUEST['surname']) && isset($_REQUEST['type']) && isset($_REQUEST['number'])) {
    $userid = $_SESSION['userid'];
    $name = sanitizeString($_REQUEST['name']);
    $surname = sanitizeString($_REQUEST['surname']);
    $type = sanitizeString($_REQUEST['type']);
    $num = sanitizeString($_REQUEST['number']);

    if(checkNumber($num)) {
        queryMysql("INSERT INTO metodipagamento (cliente, nome, cognome, tipo_carta, num_carta) VALUES ('$userid', '$name', '$surname', '$type', '$num');");
        redirect('payments.php');
    }
}

$smarty->display('add-payment.html');
unset($_SESSION['error']);

function checkNumber($num) {
    $digits = strlen($num);
    if ($digits > 10 && $digits <20) {
        return true;
    }
    $_SESSION['error'] = 1;
    redirect('add-payment.php');
    return false;
}