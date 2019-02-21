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


//intercetta l'ordinamento dello shop da jquery
if(isset($_REQUEST['sorting'])){
    if($_REQUEST['sorting'] == "lth") {
        $sorting = "prodotto.prezzo ASC";
    }
    else {
        $sorting = "prodotto.prezzo DESC";
    }
}
else {
    $sorting = "prodotto.id DESC";
}

//intercetta limite min e max al prezzo da jquery
if(isset($_REQUEST['price_min']) && isset($_REQUEST['price_max'])){
    $min = $_REQUEST['price_min'];
    $max = $_REQUEST['price_max'];
}
else {
    $min = 0;
    $max = 20000;
}

//Retrieve shop
$option = "";

//effettua la ricerca
if (isset($_REQUEST['search-product'])) {
    $str = $_REQUEST['search-product'];
    $result = searchProductByName($str, $min, $max, $sorting);
}
//mostra prodotti nel catalogo scelto
elseif(isset($_REQUEST['catalogue'])){
    $catalogue = $_REQUEST['catalogue'];
    $option = $_REQUEST['catalogue'];
    $result = searchProductByCatalogue($catalogue, $min, $max, $sorting);
}
//mosta prodotti in sconto
elseif(isset($_REQUEST['onsale'])){
    $option = "onsale";
    $result = searchOnSale($min, $max, $sorting);
}
//mostra prodotti nella categoria scelta
elseif(isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
    $result = searchProductByCategory($category, $min, $max, $sorting);
}
//mostra tutti i prodotti
else {
    $result = searchProduct($min, $max, $sorting);
}

$smarty->assign("option", "$option");

//Retrieve products from db
$product = array();
$product_num = $result->num_rows;

//Pagination manager
if(isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    $smarty->assign("page", "$page");
}
else {
    $page = 1;
    $smarty->assign("page", "$page");
}
$last = (int)($product_num/12)+1; //ci restituisce il massimo numero di pagine
$smarty->assign("last", "$last");


//Mostra il numero di prodotti mostrati e il totale
$loopiteration = 0;
$firstUnseenProd = ($page-1)*12;
if ($product_num > 0) {
    for ($j = $firstUnseenProd; $j < $product_num; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();
        $loopiteration++;
    }


    $smarty->assign("init", $firstUnseenProd+1); //primo prodotto mostrato
    $smarty->assign("total_prd", $product_num); //totale prodotti

    if($loopiteration > 12) {
        $smarty->assign("prd", ($page)*12); //ultimo prodotto mostrato se ci sono più di altri 12 prodotti
    }
    else {
        $smarty->assign("prd", ($firstUnseenProd*12)+(count($product))); //ultimo prodotto mostrato se ci sono meno di altri 12 prodotti
    }

    $smarty->assign("products", $product);
    $smarty->display('html/shop.html');
    unset($option);
}
else {
    $smarty->display('html/shop-empty.html');
    unset($option);
}
