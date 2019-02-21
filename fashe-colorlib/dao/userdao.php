<?php

require_once 'functions.php';


//UTENTE

function addUser($user, $password, $email, $data, $ruolo) {
    queryMysql("INSERT INTO cliente (username, password, email, data_reg, ruolo) VALUES ('$user', '$password', '$email', '$data', '$ruolo');");
}


function checkLogin($username, $pass) {
    $query = "SELECT id, username, ruolo FROM cliente WHERE password = '$pass' AND username = '$username';";
    $result = queryMysql($query);
    return $result;
}

function setUsername($userid, $username) {
    queryMysql("UPDATE cliente SET username = '$username' WHERE id = '$userid';");
}

function checkUsername($username) {
    $query = "SELECT username FROM cliente WHERE username = '$username';";
    $result = queryMysql($query);
    return $result;
}

function setPassword($userid, $pass) {
    queryMysql("UPDATE cliente SET password = '$pass' WHERE id = '$userid';");
}

function getMail($username) {
    $query = "SELECT email FROM cliente WHERE username = '$username';";
    $result = queryMysql($query);
    return $result;
}

function setMail($userid, $mail) {
    queryMysql("UPDATE cliente SET email = '$mail' WHERE id = '$userid';");
}

function checkMail($mail) {
    $query = "SELECT email FROM cliente WHERE email = '$mail';";
    $result = queryMysql($query);
    return $result;
}


//INDIRIZZI
function addAddress($alias, $userid, $name, $surname, $add, $civ, $city, $reg, $cap, $country) {
    queryMysql("INSERT INTO indirizzi (alias, cliente, nome, cognome, indirizzo, civico, citta, provincia, cap, stato) VALUES ('$alias', '$userid', '$name', '$surname', '$add', '$civ', '$city', '$reg', '$cap', '$country');");
}

function getAlias($userid, $newalias) {
    $query = "SELECT alias FROM indirizzi WHERE alias = '$newalias' AND cliente = '$userid';";
    $result = queryMysql($query);
    return $result;
}

function getAddresses($userid) {
    $query = "SELECT alias, nome, cognome, indirizzo, civico, citta, provincia, cap, stato FROM indirizzi WHERE cliente = '$userid' AND eliminato = '0';";
    $result = queryMysql($query);
    return $result;
}

function deleteAddress($aid, $userid) {
    queryMysql("UPDATE indirizzi SET eliminato = '1' WHERE alias = '$aid' AND cliente = '$userid';");
}


//METODI DI PAGAMENTO

function addPaymentMethod($userid, $name, $surname, $type, $num) {
    queryMysql("INSERT INTO metodipagamento (cliente, nome, cognome, tipo_carta, num_carta) VALUES ('$userid', '$name', '$surname', '$type', '$num');");
}

function getPaymentMethods($userid) {
    $query = "SELECT id, nome, cognome, tipo_carta, num_carta FROM metodipagamento WHERE cliente = '$userid' AND eliminato = '0';";
    $result = queryMysql($query);
    return $result;
}

function deletePaymentMethod($paymentid) {
    queryMysql("UPDATE metodipagamento SET eliminato = '1' WHERE id = '$paymentid';");
}


//CARRELLO

function addProductToCart($userid, $pid, $quantity, $color, $size) {
    queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$userid', '$pid', '$quantity', '$color', '$size');");
}

function getCart($userid) {
    $query = "SELECT prodotto, quantita, colore, taglia FROM carrello WHERE cliente = '$userid';";
    $result = queryMysql($query);
    return $result;
}

function deleteCart($userid) {
    queryMysql("DELETE FROM carrello WHERE carrello.cliente = '$userid';");
}

function updateQuantity($userid, $pid, $quantity, $color, $size) {
    queryMysql("UPDATE carrello SET quantita = '$quantity' WHERE cliente = '$userid' AND prodotto = '$pid' AND colore = '$color' AND taglia = '$size';");
}

function checkCartProduct($userid, $product, $color, $size) {
    $query = "SELECT prodotto FROM carrello WHERE cliente = '$userid' AND prodotto = '$product' AND colore = '$color' AND taglia = '$size';";
    $result = queryMysql($query);
    return $result;
}

function getCartProducts($userid, $date) {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, carrello.quantita, prodottoscontato.prezzo, carrello.colore, carrello.taglia FROM carrello, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE carrello.cliente = '$userid' AND prodotto.id = carrello.prodotto AND immagine.prodotto = carrello.prodotto AND immagine.principale = 1 ORDER BY prodotto.id;";
    $result = queryMysql($query);
    return $result;
}

function getCartProductsForOrders($userid, $date) {
    $query = "SELECT carrello.prodotto, carrello.quantita, carrello.colore, carrello.taglia, prodotto.prezzo, prodottoscontato.prezzo FROM carrello, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE cliente = '$userid' AND carrello.prodotto = prodotto.id;";
    $result = queryMysql($query);
    return $result;
}

function updateCartProduct($userid, $pid, $quantity, $color, $size) {
    queryMysql("UPDATE carrello SET quantita = '$quantity' WHERE cliente = '$userid' AND prodotto = '$pid' AND colore = '$color' AND taglia = '$size';");
}

function deleteCartProduct($userid, $pid) {
    queryMysql("DELETE FROM carrello WHERE cliente = '$userid' AND prodotto = '$pid';");
}

function getProductQuantityInCart($userid, $pid) {
    $query = "SELECT quantita, colore, taglia FROM carrello WHERE cliente = '$userid' AND prodotto = '$pid';";
    $result = queryMysql($query);
    return $result;
}

//MESSAGGI

function addMessage($name, $number, $email, $text) {
    queryMysql("INSERT INTO messaggi (nome, numero, email, messaggio) VALUES ('$name', '$number', '$email', '$text');");
}
