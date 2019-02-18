<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';


//Session management procedure
sessionManagerRestricted();

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
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['type']) && isset($_POST['number'])) {
    $userid = $_SESSION['userid'];
    $name = sanitizeString($_POST['name']);
    $surname = sanitizeString($_POST['surname']);
    $type = sanitizeString($_POST['type']);
    $num = sanitizeString($_POST['number']);

    if(checkNumber($num)) {
        queryMysql("INSERT INTO metodipagamento (cliente, nome, cognome, tipo_carta, num_carta) VALUES ('$userid', '$name', '$surname', '$type', '$num');");
        redirect('payments.php');
    }
}

$smarty->display('add-payment.html');
unset($_SESSION['error']);

function checkNumber($num) {
    $digits = strlen($num);
    if ($digits == 16) {
        return true;
    }
    $_SESSION['error'] = 1;
    redirect('add-payment.php');
    return false;
}