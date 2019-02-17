<?php
/* Smarty version 3.1.33, created on 2018-10-30 08:51:42
  from 'C:\wamp64\www\header.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bd81b9e7be7e9_44420270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '158fe9006551b22cde9572f84158feb825c83829' => 
    array (
      0 => 'C:\\wamp64\\www\\header.php',
      1 => 1540889481,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bd81b9e7be7e9_44420270 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php

';?>require 'libs/Smarty.class.php';

$smarty = new Smarty;

$smarty->assign("user", "asdf@gmail.to");

$smarty->display('header.html');<?php }
}
