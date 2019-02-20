<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';


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
$date = str_replace(" ", "", date('Y m d'));

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
$query = "SELECT catalogo.nome, categoria.nome, prodotto.nome FROM prodotto, categoria, catalogo WHERE catalogo.id = (SELECT prodotto.catalogo FROM prodotto WHERE prodotto.nome = '$nome') AND categoria.id = (SELECT prodotto.categoria FROM prodotto WHERE prodotto.nome = '$nome') AND prodotto.nome = '$nome';";
$result = queryMysql($query);
$result->data_seek(0);
$menu = $result->fetch_row();

$smarty->assign("catalogo", $menu[0]);
$smarty->assign("categoria", $menu[1]);
$smarty->assign("nome", $menu[2]);

//Populate product's details
$query = "SELECT prodotto.nome, prodotto.desc_breve, prodotto.desc_dett, prodotto.prezzo, prodottoscontato.prezzo FROM prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.nome = '$nome';";
$result = queryMysql($query);
$result->data_seek(0);
$details = $result->fetch_row();

$smarty->assign("prodotto", $details[0]);
$smarty->assign("desc1", $details[1]);
$smarty->assign("desc2", $details[2]);
$smarty->assign("prezzo", $details[3]);
$smarty->assign("prezzos", $details[4]);

//Populate size options
$query = "SELECT taglia.taglia FROM prodotto, taglia WHERE prodotto.nome = '$nome' AND prodotto.id = taglia.prodotto;";
$result = queryMysql($query);
$sizes = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $sizes[] = $result->fetch_row();
}

$smarty->assign("sizes", $sizes);

//Populate color options
$query = "SELECT colore.colore FROM prodotto, colore WHERE prodotto.nome = '$nome' AND prodotto.id = colore.prodotto;";
$result = queryMysql($query);
$colors = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $colors[] = $result->fetch_row();
}

$smarty->assign("colors", $colors);

//Implement availability string
$pid = getProductId($nome);

$query = "SELECT disponibilita FROM magazzino WHERE prodotto = '$pid';";
$result = queryMysql($query);
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
$query = "SELECT immagine.path FROM immagine, prodotto WHERE prodotto.nome = '$nome' AND prodotto.id = immagine.prodotto";
$result = queryMysql($query);
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
$query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM categoria, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE categoria.nome = '$menu[1]' AND prodotto.nome != '$nome' AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
$result = queryMysql($query);
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
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM catalogo, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE catalogo.nome = '$menu[2]' AND prodotto.nome != '$nome' AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
    $result = queryMysql($query);
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

    $pid = getProductId($nome);

    queryMysql("INSERT INTO prodottoscontato (prodotto, data_inizio, data_fine, prezzo) VALUES ($pid, $start, $end, $price);");
    redirect("shop.php");
}

$smarty->display('html/product-detail.html');




//recupera l'id del prodotto dal nome
function getProductId($name) {
    $query = "SELECT id FROM prodotto WHERE prodotto.nome = '$name';";
    $result = queryMysql($query);
    $product = $result->fetch_row();
    return $product[0];
}