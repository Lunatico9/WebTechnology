<?php
/* Smarty version 3.1.33, created on 2019-02-09 14:55:16
  from 'C:\wamp64\www\login.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c5ee9d4da5483_40351847',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b138a95a30496ad4968fe4542d6cef530ec2464a' => 
    array (
      0 => 'C:\\wamp64\\www\\login.php',
      1 => 1549724111,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c5ee9d4da5483_40351847 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php

';?>require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Guest';
    $_SESSION['userrole'] = 'g';
}

$smarty = new Smarty;

//Header values
$items = cartItems(1);
$smarty->assign("items", "$items");

$username = $_SESSION['username'];
$smarty->assign("user", "$username");

//Retrive form data
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
}

$query = "SELECT id, username, ruolo FROM cliente WHERE username = '$user' AND password = '$pass';";
$result = queryMysql($query);
$u = $result->fetch_row();

if($result->num_rows > 0){
    $_SESSION['userid'] = $u['id'];
    $_SESSION['username'] = $u['username'];
    $_SESSION['userrole'] = $u[0]['ruolo'];
    if($_SESSION['userrole'] == 'a')
        $smarty->display('adminpanel.php');
    else
        $smarty->display('userpanel.php');
}

else {
    $smarty->display('login.html');
}<?php }
}
