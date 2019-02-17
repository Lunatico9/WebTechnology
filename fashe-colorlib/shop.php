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

//Retrieve shop
$date = date('Y m d');

if(isset($_REQUEST['price_min']) && isset($_REQUEST['price_max'])){
    $min = $_REQUEST['price_min'];
    $max = $_REQUEST['price_max'];
}
else {
    $min = 0;
    $max = 20000;
}

if (isset($_REQUEST['search-product'])) {
    $str = $_REQUEST['search-product'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' AND prodotto.nome LIKE '%$str%';";
}

elseif(isset($_REQUEST['catalogue'])){
    $catalogue = $_REQUEST['catalogue'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' AND prodotto.catalogo = (SELECT id FROM catalogo WHERE catalogo.nome = '$catalogue');";
}

elseif(isset($_REQUEST['onsale'])){
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto, prodottoscontato WHERE prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' AND prodotto.id = immagine.prodotto AND prodottoscontato.prezzo >= '$min' AND prodottoscontato.prezzo <= '$max' AND immagine.principale = 1;";
}

elseif(isset($_REQUEST['category'])){
    $category = $_REQUEST['category'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' AND prodotto.categoria = (SELECT categoria.id FROM categoria WHERE categoria.nome = '$category');";
}

else {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1;";
}

$result = queryMysql($query);
$product = array();
$product_num = $result->num_rows;

if($product_num > 12) {
    $smarty->assign("prd", "12");
    $smarty->assign("total_prd", "$product_num");
}
else {
    $smarty->assign("prd", "$product_num");
    $smarty->assign("total_prd", "$product_num");
}

if ($product_num > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();
    }

    $smarty->assign("products", $product);
    $smarty->display('shop.html');
}
else {
    $smarty->display('shop-empty.html');
}
