<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/orderdao.php';


//Session management procedure
sessionManagerRestricted();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}

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
if(isset($_POST['name']) && isset($_POST['number']) && isset($_POST['email']) && isset($_POST['message'])) {
    $userid = $_SESSION['userid'];
    $name = sanitizeString($_POST['name']);
    $num = sanitizeString($_POST['number']);
    $email = sanitizeString($_POST['email']);
    $message = sanitizeString($_POST['message']);

    if(checkOrder($userid, $num)) {
        addMessage($name, $num, $email, $message);
        redirect('orders.php');
    }
}

$smarty->display('html/order-support.html');
unset($_SESSION['error']);

//controlla che il numero inserito corrisponda con un ordine effettuatto dall'utente
function checkOrder($uid, $num) {
    $result = getUserOrders($uid);

    if ($result->num_rows > 0) {
        for ($j = 0; $j < $result->num_rows; ++$j) {
            $result->data_seek($j);
            $product = $result->fetch_row();
            if ($product[0] == $num) {
                return true;
            }
        }
        $_SESSION['error'] = 1;
        redirect('order-support.php');
        return false;
    }
    else {
        $_SESSION['error'] = 1;
        redirect('order-support.php');
        return false;
    }
}