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

//recuper il valore da jquery
$orderid = $_POST['detail'];
$smarty->assign("order", $orderid);

//Retrieve order's address
$result = getShipping($orderid);
$u = $result->fetch_row();

$smarty->assign("addname", $u[0]. " ". $u[1]);
$smarty->assign("address", $u[2]. ", ". $u[3]);
$smarty->assign("courier", $u[4]);
$smarty->assign("shipStatus", $u[5]);

//Retrieve order's payment
$result = getPayment($orderid);
$u = $result->fetch_row();

$smarty->assign("payname", $u[0]. " ". $u[1]);
$smarty->assign("card", $u[2]. " ". $u[3]);
$smarty->assign("status", $u[4]);


//Retrieve order's products
$result = getOrderProduct($orderid);
$product = array();

if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();
    }
    $smarty->assign("products", $product);
}
else {
    redirect("orders.php");
}

$smarty->display('html/order-detail.html');



