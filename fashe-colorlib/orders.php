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

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}

$userid = $_SESSION['userid'];
//Retrieve orders
$query = "SELECT ordine.id, ordine.eseguito, ordine.stato, ordine.indirizzo, ordine.totale FROM ordine WHERE ordine.cliente = '$userid' ORDER BY ordine.eseguito DESC;";
$result = queryMysql($query);
$order = array();

if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $order[] = $result->fetch_row();
        $order[$j][1] = date('m/d/Y', strtotime($order[$j][1]));
    }

    $smarty->assign("orders", $order);
    $smarty->display('orders.html');
}
else {
    $smarty->display('orders-empty.html');
}

