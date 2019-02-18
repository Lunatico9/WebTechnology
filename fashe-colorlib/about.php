<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['userid'])){
    if(isset($_COOKIE['userid'])){
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        $_SESSION['username'] = 'Guest';
        $_SESSION['userrole'] = 'g';
    } 
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

$smarty->display('about.html');