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
