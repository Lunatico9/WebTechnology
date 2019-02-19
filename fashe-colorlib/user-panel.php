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

//recuperiamo la mail dell'utente dal database
$query = "SELECT email FROM cliente WHERE username = '$username';";
$result = queryMysql($query);
$u = $result->fetch_row();
    
if($result->num_rows > 0) {
    $mail = $u[0];
}
else {
    $mail = "";
}

$smarty->assign("username", "$username");
$smarty->assign("mail", "$mail");

$smarty->display('user-panel.html');
