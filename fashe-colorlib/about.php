<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(isset($_COOKIE['userid'])){
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['userrole'] = $_COOKIE['userrole'];
}

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Guest';
    $_SESSION['userrole'] = 'g';
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//Retrieve form data
if (isset($_REQUEST['name'])) {

}

$smarty->display('about.html');