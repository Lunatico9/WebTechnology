<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/productdao.php';

//Session management procedure
sessionManager();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//Popoliamo le vetrine nella home in maniera dinamica

//Best Seller values
$result = getWindowProducts("Best Seller");

for ($j = 0 ; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $product = $result->fetch_row();
    $smarty->assign("product"."$j", "$product[0]");
    $smarty->assign("price"."$j", "$product[1]");
    $smarty->assign("img"."$j", "$product[2]");
}

//On Sale values
$result = getWindowProducts("On Sale");

for ($j = 0 ; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $product = $result->fetch_row();
    $smarty->assign("saleproduct"."$j", "$product[0]");
    $smarty->assign("oldprice"."$j", "$product[1]");
    $smarty->assign("saleimg"."$j", "$product[2]");
    $smarty->assign("newprice"."$j", "$product[3]");
}

$smarty->display('index.html');