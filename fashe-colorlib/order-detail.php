<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['userid'])) {
    if(isset($_COOKIE['userid'])) {
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        redirect("login.php");
    }
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

$orderid = $_POST['detail'];
$smarty->assign("order", $orderid);

//Retrieve order's address
$query = "SELECT indirizzi.nome, indirizzi.cognome, indirizzi.indirizzo, indirizzi.civico, spedizione.corriere, spedizione.stato FROM ordine, indirizzi, spedizione WHERE ordine.id = '$orderid' AND ordine.indirizzo = indirizzi.alias AND spedizione.ordine = ordine.id";
$result = queryMysql($query);
$u = $result->fetch_row();

$smarty->assign("addname", $u[0]. " ". $u[1]);
$smarty->assign("address", $u[2]. ", ". $u[3]);
$smarty->assign("courier", $u[4]);
$smarty->assign("shipStatus", $u[5]);

//Retrieve order's payment
$query = "SELECT metodipagamento.nome, metodipagamento.cognome, metodipagamento.tipo_carta, metodipagamento.num_carta, pagamento.stato FROM ordine, pagamento, metodipagamento WHERE ordine.id = '$orderid' AND ordine.id = pagamento.ordine AND metodipagamento.id = pagamento.metodo;";
$result = queryMysql($query);
$u = $result->fetch_row();

$smarty->assign("payname", $u[0]. " ". $u[1]);
$smarty->assign("card", $u[2]. " ". $u[3]);
$smarty->assign("status", $u[4]);


//Retrieve order's products
$query = "SELECT prodotto.nome, immagine.path, acquisto.quantita, acquisto.colore, acquisto.taglia, acquisto.prezzo FROM immagine, prodotto, acquisto WHERE acquisto.ordine = '$orderid' AND prodotto.id = acquisto.prodotto AND immagine.prodotto = acquisto.prodotto AND immagine.principale = 1;";
$result = queryMysql($query);
$product = array();

if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();
    }
    $smarty->assign("products", $product);
}
else {
    redirect("orders.php");
}

$smarty->display('order-detail.html');



