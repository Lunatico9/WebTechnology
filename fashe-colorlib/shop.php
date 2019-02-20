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
$date = str_replace(" ", "", date('Y m d'));
$option = "";

//effettua la ricerca
if (isset($_REQUEST['search-product'])) {
    $str = $_REQUEST['search-product'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' AND prodotto.nome LIKE '%$str%' ORDER BY $sorting;";
}
//mostra prodotti nel catalogo scelto
elseif(isset($_REQUEST['catalogue'])){
    $catalogue = $_REQUEST['catalogue'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' AND prodotto.catalogo = (SELECT id FROM catalogo WHERE catalogo.nome = '$catalogue' ORDER BY $sorting);";
    $option = $_REQUEST['catalogue'];
}
//mosta prodotti in sconto
elseif(isset($_REQUEST['onsale'])){
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto, prodottoscontato WHERE prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' AND prodotto.id = immagine.prodotto AND prodottoscontato.prezzo >= '$min' AND prodottoscontato.prezzo <= '$max' AND immagine.principale = 1;";
    $option = "onsale";
}
//mostra prodotti nella categoria scelta
elseif(isset($_REQUEST['category'])) {
    $category = $_REQUEST['category'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.categoria = (SELECT categoria.id FROM categoria WHERE categoria.nome = '$category' ORDER BY $sorting);";
}
//mostra tutti i prodotti
else {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = immagine.prodotto AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' ORDER BY $sorting;";
}

$smarty->assign("option", "$option");

//Retrieve products from db
$result = queryMysql($query);
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
