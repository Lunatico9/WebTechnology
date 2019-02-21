<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/userdao.php';

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

//intercept delete
if (isset($_POST['delete'])) {
    $userid = $_SESSION['userid'];
    $del = $_POST['delete'];
    deleteAddress($aid, $userid);
}

//recuperiamo gli indirizzi dell'utente dal database
$userid = $_SESSION['userid'];
$result = getAddresses($userid);
$address = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $address[] = $result->fetch_row();
    }

    $smarty->assign("addresses", $address);
    $smarty->display('html/addresses.html');
}
else {
    $smarty->display('html/addresses-empty.html');
}