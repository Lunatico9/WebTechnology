<?php

require_once 'functions.php';

//ORDINI

function addOrder($userid, $status, $address, $total) {
    queryMysql("INSERT INTO ordine (cliente, stato, indirizzo, totale) VALUES ('$userid', '$status', '$address', '$total');");
}

function getOrders($userid) {
    $query = "SELECT ordine.id, ordine.eseguito, ordine.stato, ordine.indirizzo, ordine.totale FROM ordine WHERE ordine.cliente = '$userid' ORDER BY ordine.eseguito DESC;";
    $result = queryMysql($query);
    return $result;
}

function getUserOrders($uid) {
    $query = "SELECT id FROM ordine WHERE cliente = '$uid';";
    $result = queryMysql($query);
    return $result;
}

function addShipping($orderid, $courier, $status) {
    queryMysql("INSERT INTO spedizione (corriere, ordine, stato) VALUES ('$courier', '$orderid', '$status');");
}

function getShipping($orderid) {
    $query = "SELECT indirizzi.nome, indirizzi.cognome, indirizzi.indirizzo, indirizzi.civico, spedizione.corriere, spedizione.stato FROM ordine, indirizzi, spedizione WHERE ordine.id = '$orderid' AND ordine.indirizzo = indirizzi.alias AND spedizione.ordine = ordine.id";
    $result = queryMysql($query);
    return $result;
}

function addPayment($orderid, $payment, $status) {
    queryMysql("INSERT INTO pagamento (ordine, metodo, stato) VALUES ('$orderid', '$payment', '$status');");
}

function getPayment($orderid) {
    $query = "SELECT metodipagamento.nome, metodipagamento.cognome, metodipagamento.tipo_carta, metodipagamento.num_carta, pagamento.stato FROM ordine, pagamento, metodipagamento WHERE ordine.id = '$orderid' AND ordine.id = pagamento.ordine AND metodipagamento.id = pagamento.metodo;";
    $result = queryMysql($query);
    return $result;
}

function addBoughtProduct($orderid, $id, $quantity, $color, $size, $price) {
    queryMysql("INSERT INTO acquisto (ordine, prodotto, quantita, colore, taglia, prezzo) VALUES ('$orderid', '$id', '$quantity', '$color', '$size', '$price');");
}

function getOrderProduct($orderid) {
    $query = "SELECT prodotto.nome, immagine.path, acquisto.quantita, acquisto.colore, acquisto.taglia, acquisto.prezzo FROM immagine, prodotto, acquisto WHERE acquisto.ordine = '$orderid' AND prodotto.id = acquisto.prodotto AND immagine.prodotto = acquisto.prodotto AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}

//CORRIERI

function getCouriers() {
    $query = "SELECT nome, costo FROM corriere";
    $result = queryMysql($query);
    return $result;
}