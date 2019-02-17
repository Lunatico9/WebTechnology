<?php

require_once 'libs/Smarty.class.php';
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
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//AJAX have to call this function to update
function update($updates) {
    $j = count($updates);
    $i = 0;
    while ($i<$j){
        $up = $updates[$i]['nome'];
        $query =  "SELECT id FROM prodotto WHERE prodotto.nome = '$up';";
        $result = queryMysql($query);
        $p = $result->fetch_row();
        $prd = $p[0];
        $u = $_SESSION['userid'];
        $q = $updates[$i]['quantita'];
        $query = "UPDATE carrello SET quantita = '$q' WHERE cliente = '$u' AND prodotto = '$prd';";
        queryMysql($query);
    }
    $smarty = new Smarty;
    $smarty->display('cart.html');
}

//Intercept delete
if (isset($_REQUEST['delete'])) {
    $del = $_REQUEST['delete'];
    $query =  "DELETE FROM carrello WHERE carrello.cliente = 1 AND carrello.prodotto = (SELECT id FROM prodotto WHERE prodotto.nome = '$del');";
    queryMysql($query);
}

//Retrieve cart
$date = date('Y m d');

$query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, carrello.quantita, prodottoscontato.prezzo FROM carrello, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE carrello.cliente = 1 AND prodotto.id = carrello.prodotto AND immagine.prodotto = carrello.prodotto AND immagine.principale = 1;";
$result = queryMysql($query);
$product = array();

if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();
    }

    $smarty->assign("products", $product);
    $smarty->display('cart.html');
}

else  {
    $smarty->display('cart-empty.html');
}



