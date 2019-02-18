<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(isset($_COOKIE['userid'])){
    $_SESSION['userid'] = $_COOKIE['userid'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['userrole'] = $_COOKIE['userrole'];
}

if(!isset($_SESSION['username'])){
    redirect("login.php");
}

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

$userid = $_SESSION['userid'];

//recuper total tramite jquery
$total = $_POST['total'];
$smarty->assign("total", $total);

//Popola address options
$query = "SELECT alias, nome, cognome, indirizzo, civico, citta, cap, provincia FROM indirizzi WHERE cliente = '$userid';";
$result = queryMysql($query);
$address = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $address[] = $result->fetch_row();
}

$smarty->assign("addresses", $address);

//Populate payment options
$query = "SELECT id, nome, cognome, tipo_carta, num_carta FROM metodipagamento WHERE cliente = '$userid';";
$result = queryMysql($query);
$payment = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $payment[] = $result->fetch_row();
    $payment[$j][4] = "********* ". substr($payment[$j][4],12,strlen($payment[$j][4]));
}

$smarty->assign("payments", $payment);

//Populate courier options
$query = "SELECT id, nome, costo FROM corriere";
$result = queryMysql($query);
$courier = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $courier[] = $result->fetch_row();
}

$smarty->assign("deloptions", $courier);

//Intercettiamo la conferma dell'ordine
if(isset($_POST['address']) && isset($_POST['payment']) && isset($_POST['courier'])) {
    $total = $_POST['total']
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $courier = $_POST['courier'];

    $status = "Received";
    $date = date('Y m d');

    //inseriamo l'ordine nel db
    queryMysql("INSERT INTO ordine (cliente, stato, indirizzo, totale) VALUES ('$userid', '$status', '$address', '$total');");

    //recuperiamo l'id appena creato
    $query = "SELECT LAST_INSERT_ID();";
    $result = queryMysql($query);
    $order = $result->fetch_row();
    $orderid = $order[0];

    //inseriamo il pagamento e la spedizione nel db
    queryMysql("INSERT INTO pagamento (ordine, metodo, stato) VALUES ('$orderid', '$payment', '$status');");
    queryMysql("INSERT INTO spedizione (corriere, ordine, stato) VALUES ('$courier', '$orderid', '$status');");

    //recuperiamo i prodotti dal carrello
    $query = "SELECT carrello.prodotto, carrello.quantita, carrello.colore, carrello.taglia, prodotto.prezzo, prodottoscontato.prezzo FROM carrello, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto  AND prodottoscontato.data_inizio > '$date' AND prodottoscontato.data_fine < '$date' WHERE cliente = '$userid' AND carrello.prodotto = prodotto.id;";
    $result = queryMysql($query);
    $product = array();
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();

        $id = $product[$j][0];
        $quantity = $product[$j][1];
        $color = $product[$j][2];
        $size = $product[$j][3];

        if(isset($product[$j][5])) {
            $price = $product[$J][5];
            queryMysql("INSERT INTO acquisto (ordine, prodotto, quantita, colore, taglia, prezzo) VALUES ('$orderid', '$id', '$quantity', '$color', '$size', '$price');");
        }
        else {
            $price = $product[$j][4];
            queryMysql("INSERT INTO acquisto (ordine, prodotto, quantita, colore, taglia, prezzo) VALUES ('$orderid', '$id', '$quantity', '$color', '$size', '$price');");
        }
    }
    //eliminiamo tutti i prodotti dal carrello
    queryMysql("DELETE FROM carrello WHERE carrello.cliente = '$userid';");

    //messaggio di conferma 

    redirect("index.php");
}

$smarty->display('checkout.html');