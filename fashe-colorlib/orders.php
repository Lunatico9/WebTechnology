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

$userid = $_SESSION['userid'];
//Retrieve orders
$result = getOrders($userid);
$order = array();

if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $order[] = $result->fetch_row();
        $order[$j][1] = date('m/d/Y', strtotime($order[$j][1]));
    }

    $smarty->assign("orders", $order);
    $smarty->display('html/orders.html');
}
else {
    $smarty->display('html/orders-empty.html');
}

