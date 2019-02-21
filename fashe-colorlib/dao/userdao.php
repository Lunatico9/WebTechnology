<?php

require_once 'functions.php';


//UTENTE

/**
 * Aggiunge utente al database
 */
function addUser($user, $password, $email, $data, $ruolo) {
    queryMysql("INSERT INTO cliente (username, password, email, data_reg, ruolo) VALUES ('$user', '$password', '$email', '$data', '$ruolo');");
}

/**
 * Controlla se esiste coppia username-password nel database
 */
function checkLogin($username, $pass) {
    $query = "SELECT id, username, ruolo FROM cliente WHERE password = '$pass' AND username = '$username';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Modifica lo username di un utente
 */
function setUsername($userid, $username) {
    queryMysql("UPDATE cliente SET username = '$username' WHERE id = '$userid';");
}

/**
 * Controlla se lo username sia già presente nel database
 */
function checkUsername($username) {
    $query = "SELECT username FROM cliente WHERE username = '$username';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Modifica la password di un utente
 */
function setPassword($userid, $pass) {
    queryMysql("UPDATE cliente SET password = '$pass' WHERE id = '$userid';");
}

/**
 * Restituisce l'indirizzo email di un utente
 */
function getMail($username) {
    $query = "SELECT email FROM cliente WHERE username = '$username';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Modifica l'indirizzo email di un utente
 */
function setMail($userid, $mail) {
    queryMysql("UPDATE cliente SET email = '$mail' WHERE id = '$userid';");
}

/**
 * Controlla se l'indirizzo email sia già presente nel database
 */
function checkMail($mail) {
    $query = "SELECT email FROM cliente WHERE email = '$mail';";
    $result = queryMysql($query);
    return $result;
}


//INDIRIZZI

/**
 * Aggiunge indirizzo per un utente al database
 */
function addAddress($alias, $userid, $name, $surname, $add, $civ, $city, $reg, $cap, $country) {
    queryMysql("INSERT INTO indirizzi (alias, cliente, nome, cognome, indirizzo, civico, citta, provincia, 
                cap, stato) VALUES ('$alias', '$userid', '$name', '$surname', '$add', '$civ', '$city', 
                '$reg', '$cap', '$country');");
}

/**
 * Restituisce la chiave di indirizzi
 */
function getAlias($userid, $newalias) {
    $query = "SELECT alias FROM indirizzi WHERE alias = '$newalias' AND cliente = '$userid';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti gli indirizzi di un utente
 */
function getAddresses($userid) {
    $query = "SELECT alias, nome, cognome, indirizzo, civico, citta, provincia, cap, stato 
              FROM indirizzi WHERE cliente = '$userid' AND eliminato = '0';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Elimina un indirizzo
 */
function deleteAddress($aid, $userid) {
    queryMysql("UPDATE indirizzi SET eliminato = '1' WHERE alias = '$aid' AND cliente = '$userid';");
}


//METODI DI PAGAMENTO

/**
 * Aggiunge metodo di pagamento per un utente al database
 */
function addPaymentMethod($userid, $name, $surname, $type, $num) {
    queryMysql("INSERT INTO metodipagamento (cliente, nome, cognome, tipo_carta, num_carta) 
                VALUES ('$userid', '$name', '$surname', '$type', '$num');");
}

/**
 * Restituisce tutti i metodi di pagamento di un utente
 */
function getPaymentMethods($userid) {
    $query = "SELECT id, nome, cognome, tipo_carta, num_carta FROM metodipagamento 
              WHERE cliente = '$userid' AND eliminato = '0';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce metodo di pagamento per un utente
 */
function deletePaymentMethod($paymentid) {
    queryMysql("UPDATE metodipagamento SET eliminato = '1' WHERE id = '$paymentid';");
}


//CARRELLO

/**
 * Aggiunge prodotto al carrello
 */
function addProductToCart($userid, $pid, $quantity, $color, $size) {
    queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) 
                VALUES ('$userid', '$pid', '$quantity', '$color', '$size');");
}

/**
 * Restituisce tutti i prodotti nel carrello di un utente
 */
function getCart($userid) {
    $query = "SELECT prodotto, quantita, colore, taglia FROM carrello WHERE cliente = '$userid';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Elimina tutti i prodotti nel carrello di un utente
 */
function deleteCart($userid) {
    queryMysql("DELETE FROM carrello WHERE carrello.cliente = '$userid';");
}

/**
 * Aggiorna la quantità di un prodotto nel carrello
 */
function updateQuantity($userid, $pid, $quantity, $color, $size) {
    queryMysql("UPDATE carrello SET quantita = '$quantity' WHERE cliente = '$userid' 
                AND prodotto = '$pid' AND colore = '$color' AND taglia = '$size';");
}

/**
 * Controlla se un prodotto è già presente nel carrello
 */
function checkCartProduct($userid, $product, $color, $size) {
    $query = "SELECT prodotto FROM carrello WHERE cliente = '$userid' AND prodotto = '$product' 
              AND colore = '$color' AND taglia = '$size';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti nel carrello di un utente
 */
function getCartProducts($userid, $date) {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, carrello.quantita, 
              prodottoscontato.prezzo, carrello.colore, carrello.taglia FROM carrello, immagine, prodotto 
              LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto 
              AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' 
              WHERE carrello.cliente = '$userid' AND prodotto.id = carrello.prodotto 
              AND immagine.prodotto = carrello.prodotto AND immagine.principale = 1 ORDER BY prodotto.id;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti nel carrello di un utente senza immagine
 */
function getCartProductsForOrders($userid, $date) {
    $query = "SELECT carrello.prodotto, carrello.quantita, carrello.colore, carrello.taglia, prodotto.prezzo, 
              prodottoscontato.prezzo FROM carrello, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' WHERE cliente = '$userid' 
              AND carrello.prodotto = prodotto.id;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Elimina un prodotto nel carrello di un utente
 */
function deleteCartProduct($userid, $pid) {
    queryMysql("DELETE FROM carrello WHERE cliente = '$userid' AND prodotto = '$pid';");
}

/**
 * Restituisce la quantità di un prodotto nel carrello di un utente
 */
function getProductQuantityInCart($userid, $pid) {
    $query = "SELECT quantita, colore, taglia FROM carrello 
              WHERE cliente = '$userid' AND prodotto = '$pid';";
    $result = queryMysql($query);
    return $result;
}

//MESSAGGI

/**
 * Aggiunge messaggio al database
 */
function addMessage($name, $number, $email, $text) {
    queryMysql("INSERT INTO messaggi (nome, numero, email, messaggio) 
    VALUES ('$name', '$number', '$email', '$text');");
}
