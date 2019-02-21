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

//Retrieve product detail
if (isset($_REQUEST['product'])){
    $nome = $_REQUEST['product'];
}
else {
    redirect("shop.php");
}

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}

//Populate menu
$result = getProductPath($nome);
$menu = $result->fetch_row();

$smarty->assign("catalogo", $menu[0]);
$smarty->assign("categoria", $menu[1]);
$smarty->assign("nome", $menu[2]);

//Populate product's details
$result = getProduct($nome);
$result->data_seek(0);
$details = $result->fetch_row();

$smarty->assign("prodotto", $details[0]);
$smarty->assign("desc1", $details[1]);
$smarty->assign("desc2", $details[2]);
$smarty->assign("prezzo", $details[3]);
$smarty->assign("prezzos", $details[4]);

//Populate size options
$result = getSize($nome);
$sizes = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $sizes[] = $result->fetch_row();
}

$smarty->assign("sizes", $sizes);

//Populate color options
$result = getColor($nome);
$colors = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $colors[] = $result->fetch_row();
}

$smarty->assign("colors", $colors);

//Implement availability string
$pid = getProductId($nome);

if(isset($_SESSION['color']) && isset($_SESSION['size'])) {
    $c = $_SESSION['color'];
    $s = $_SESSION['size'];
    $result = getAvailability($pid, $c, $s);
}
else {
    $result = getAvailability($pid, $colors[0][0], $sizes[0][0]);
}
$row = $result->fetch_row();
$av = $row[0];

if($av > 10) {
    $availability = "In Stock";
    $stock = "text-success";
}
elseif ($av > 0) {
    $availability = "Only ". $av. " left in stock - order soon.";
    $stock = "text-warning";
}
else {
    $availability = "Currently unavailable";
    $stock = "text-danger";
}

$smarty->assign("availability", $availability);
$smarty->assign("stock", $stock);

//Populate product's images
$result = getImages($nome);
$images = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $images[] = $result->fetch_row();
}

$smarty->assign("img1", $images[0][0]);


if (isset($images[1][0])) {
    $smarty->assign("isset2", 1);
    $smarty->assign("img2", $images[1][0]);
}
else {
    $smarty->assign("isset2", 0);
}

if (isset($images[2][0])) {
    $smarty->assign("isset3", 1);
    $smarty->assign("img3", $images[2][0]);
}
else {
    $smarty->assign("isset3", 0);
}

//Poulate related products
$result = getCategoryRelatedProducts($nome, $menu[1]);
$relprod1 = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $relprod1[] = $result->fetch_row();
}

//If we have no products with same category we display products in the same catalogue
if ($relprod1 != null) {
    $smarty->assign("relprod", $relprod1);
}

else {
    $result = getCatalogueRelatedProducts($nome, $menu[2]);
    $relprod2 = array();
    
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $relprod2[] = $result->fetch_row();
    }
    $smarty->assign("relprod", $relprod2);
}

//effettua l'aggiunta sconto ad un prodotto
if (isset($_POST['discount']) && isset($_POST['start']) && isset($_POST['end'])) {
    $price = $_POST['discount'];
    $start = str_replace('-','', $_POST['start']);
    $end = str_replace('-','', $_POST['end']);

    $pid = getProductID($nome);

    addSale($pid, $start, $end, $price);
    redirect("shop.php");
}

$smarty->display('html/product-detail.html');