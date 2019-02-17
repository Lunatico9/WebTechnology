<?php
/* Smarty version 3.1.33, created on 2018-10-31 10:40:19
  from 'C:\wamp64\www\cart-empty.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bd98693ab6031_85545300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf2b94578391ea9903d6a3ccb92a544e2c07be4b' => 
    array (
      0 => 'C:\\wamp64\\www\\cart-empty.php',
      1 => 1540982257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bd98693ab6031_85545300 (Smarty_Internal_Template $_smarty_tpl) {
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
$username = $_SESSION['username'];
$smarty->assign("user", "$username");

$items = cartItems(1);
$smarty->assign("items", "$items");

$smarty->display('cart-empty.html');<?php }
}
