<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';


//Session management procedure
session_start();

if(!isset($_SESSION['userid'])) {
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

//recuperiamo i metodi di pagamento dell'utente dal database
$userid = $_SESSION['userid'];
$query = "SELECT id, nome, cognome, tipo_carta, num_carta FROM metodipagamento WHERE cliente = '$userid';";
$result = queryMysql($query);
$payment = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $payment[] = $result->fetch_row();
        $payment[$j][4] = "********* ". substr($payment[$j][4],12,strlen($payment[$j][4]));
    }

    $smarty->assign("payments", $payment);
    $smarty->display('payments.html');
}
else {
    $smarty->display('payments-empty.html');
}

//anche questa va fatta con js
if (isset($_REQUEST['delete'])) {
    $userid = $_SESSION['userid'];
    $del = $_REQUEST['delete'];
    $query =  "DELETE FROM metodipagamento WHERE cliente = '$userid' AND id = '$del';";
    queryMysql($query);
    redirect("user-panel.php");
}


