<?php

require_once 'functions.php';

//ORDINI

/**
 * Aggiunge un ordine effettuato al database
 */
function addOrder($userid, $status, $address, $total) {
    queryMysql("INSERT INTO ordine (cliente, stato, indirizzo, totale) 
                VALUES ('$userid', '$status', '$address', '$total');");
}

/**
 * Restituisce tutti gli ordini di un utente con informazioni
 */
function getOrders($userid) {
    $query = "SELECT ordine.id, ordine.eseguito, ordine.stato, ordine.indirizzo, ordine.totale 
              FROM ordine WHERE ordine.cliente = '$userid' ORDER BY ordine.eseguito DESC;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti gli ordini di un utente
 */
function getUserOrders($uid) {
    $query = "SELECT id FROM ordine WHERE cliente = '$uid';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiunge spedizione relativa ad un ordine
 */
function addShipping($orderid, $courier, $status) {
    queryMysql("INSERT INTO spedizione (corriere, ordine, stato) 
                VALUES ('$courier', '$orderid', '$status');");
}

/**
 * Restituisce la spedizione relativa ad un ordine
 */
function getShipping($orderid) {
    $query = "SELECT indirizzi.nome, indirizzi.cognome, indirizzi.indirizzo, indirizzi.civico, 
              spedizione.corriere, spedizione.stato FROM ordine, indirizzi, spedizione 
              WHERE ordine.id = '$orderid' AND ordine.indirizzo = indirizzi.alias 
              AND spedizione.ordine = ordine.id";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiunge pagamento relativo ad un ordine
 */
function addPayment($orderid, $payment, $status) {
    queryMysql("INSERT INTO pagamento (ordine, metodo, stato) 
                VALUES ('$orderid', '$payment', '$status');");
}

/**
 * Restituisce il pagamento relativo ad un ordine
 */
function getPayment($orderid) {
    $query = "SELECT metodipagamento.nome, metodipagamento.cognome, metodipagamento.tipo_carta, 
              metodipagamento.num_carta, pagamento.stato FROM ordine, pagamento, metodipagamento 
              WHERE ordine.id = '$orderid' AND ordine.id = pagamento.ordine 
              AND metodipagamento.id = pagamento.metodo;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiunge prodotto tra gli acquisiti con un ordine
 */
function addBoughtProduct($orderid, $id, $quantity, $color, $size, $price) {
    queryMysql("INSERT INTO acquisto (ordine, prodotto, quantita, colore, taglia, prezzo) 
                VALUES ('$orderid', '$id', '$quantity', '$color', '$size', '$price');");
}

/**
 * Restituisce tutti i prodotti acquisiti con un ordine
 */
function getOrderProduct($orderid) {
    $query = "SELECT prodotto.nome, immagine.path, acquisto.quantita, acquisto.colore, acquisto.taglia, 
              acquisto.prezzo FROM immagine, prodotto, acquisto WHERE acquisto.ordine = '$orderid' 
              AND prodotto.id = acquisto.prodotto AND immagine.prodotto = acquisto.prodotto 
              AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}

//CORRIERI

/**
 * Restituisce i corrieri presenti nel database
 */
function getCouriers() {
    $query = "SELECT nome, costo FROM corriere";
    $result = queryMysql($query);
    return $result;
}