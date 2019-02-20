<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';


//Session management procedure
sessionManagerRestricted();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}


//Popola Best Seller window options
$bestSeller = retrieveWindow("Best Seller");

$smarty->assign("bestSellerProducts", $bestSeller);

//Popola On Sale window options
$onSale = retrieveWindow("On Sale");

$smarty->assign("onSaleProducts", $onSale);


//Popola Best Seller candidate options
$query = "SELECT prodotto.id, prodotto.nome FROM prodotto;";
$result = queryMysql($query);
$bsCandidates = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $bsCandidates[] = $result->fetch_row();
}

$smarty->assign("candidateBestSeller", $bsCandidates);

//Popola On Sale candidate options
$date = str_replace(" ", "", date('Y m d'));
$query = "SELECT prodotto.id, prodotto.nome FROM prodotto, prodottoscontato WHERE prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' ;";
$result = queryMysql($query);
$osCandidates = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $osCandidates[] = $result->fetch_row();
}

$smarty->assign("candidateOnSale", $osCandidates);


//Retrieve form data
if(isset($_POST['remove-bs']) && isset($_POST['add-bs'])) {
    $oldProduct = sanitizeString($_POST['remove-bs']);
    $newProduct = sanitizeString($_POST['add-bs']);

    updateWindow($oldProduct, $newProduct, "Best Seller");
}

if(isset($_POST['remove-os']) && isset($_POST['add-os'])) {
    $oldProduct = sanitizeString($_POST['remove-os']);
    $newProduct = sanitizeString($_POST['add-os']);

    updateWindow($oldProduct, $newProduct, "On Sale");
}

$smarty->display('html/edit-window.html');


//eliminiamo il vecchio prodotto in vetrina e inseriamo il nuovo
function updateWindow($old, $new, $window) {
    $result = queryMysql("SELECT id FROM vetrina WHERE nome = '$window';");
    $row = $result->fetch_row();
    $wid = $row[0];

    queryMysql("DELETE FROM evidenzia WHERE prodotto = '$old' AND vetrina = '$wid';");
    queryMysql("INSERT INTO evidenzia (prodotto, vetrina) VALUES ('$new', '$wid');");
    redirect("user-panel.php");
}

//restituisce tutti i prodotti nella vetrina indicata
function retrieveWindow($window) {
    $query = "SELECT prodotto.id, prodotto.nome FROM vetrina, evidenzia LEFT JOIN prodotto ON prodotto.id = evidenzia.prodotto WHERE evidenzia.vetrina = vetrina.id AND vetrina.nome = '$window';";

    $result = queryMysql($query);
    $products = array();

    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $products[] = $result->fetch_row();
    }

    return $products;
}


