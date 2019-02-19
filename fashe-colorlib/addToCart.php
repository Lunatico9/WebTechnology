<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';

//Session management procedure
sessionManager();

//riceve dati da jquery
$quantity = $_POST['quantity'];
$color = $_POST['color'];
$size = $_POST['size'];
$product = $_POST['product'];

$query = "SELECT id FROM prodotto WHERE nome = '$product';";
$result = queryMysql($query);
$row = $result->fetch_row();
$pid = $row[0];

//controlliamo che la quantità di prodotto non ecceda la disponibilità
$quantity = checkAvailability($pid, $quantity, $color, $size);

//se la quantità è 0
if ($quantity == 0) {
    echo 1;
}
else {
//Controlla se l'utente ha effettuato il login se non lo ha effettuato
//aggiungiamo i prodotti ad un campo della variabile di sessione
    if(!isset($_SESSION['userid'])) {
        //controlliamo se il prodoto non sia già presente nella variabile
        if(!checkProductNotLogged($pid, $quantity, $color, $size)) {
            $product = array($pid, $quantity, $color, $size);
            $_SESSION['cart'][] = $product;
            echo 0; //ajax aggiorna l'indice nell'header
        }
        else {
            echo 1; //ajax non aggiorna l'indice nell'header
        }
    }
    else {
        $userid = $_SESSION['userid'];
        //controlliamo che il prodotto non sia già presente nel carrello
        $newquantity = checkProduct($userid, $pid, $color, $size);
    
        if(!$newquantity) {
            //inseriamo nel carrello il prodotto
            queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$userid', '$pid', '$quantity', '$color', '$size');");
            echo 0;
        }
        else {
            //aumentiamo solamente la quantità del prodotto nel carrello
            $quantity += $newquantity;
            queryMysql("UPDATE carrello SET quantita = '$quantity' WHERE cliente = '$userid' AND prodotto = '$pid' AND colore = '$color' AND taglia = '$size';");
            echo 1;
        }
    }
}
    
//controlla se abbiamo abbastanza disponibilità di prodotto per soddisfare la richiesta
function checkAvailability($pid, $quantity, $color, $size) {
    $query = "SELECT disponibilita FROM magazzino WHERE prodotto = '$pid' AND colore = '$color' AND taglia = '$size';";
    $result = queryMysql($query);
    $availability = $result->fetch_row();

    if($quantity > $availability[0]) {
        return 0;
    }
    
    return $quantity;
}

//controlla se il prodotto è già presente nel carrello nel database
function checkProduct($userid, $pid, $color, $size) {
    $query = "SELECT quantita, colore, taglia FROM carrello WHERE cliente = '$userid' AND prodotto = $pid;";
    $result = queryMysql($query);

    if($result->num_rows > 0) {
        for ($j = 0; $j < $result->num_rows; ++$j) {
            $result->data_seek($j);
            $product[] = $result->fetch_row();
            if($color == $product[$j][1] && $size == $product[$j][2]) {
                return $product[$j][0];
            }
        }
    }

    return 0;
}

//controlla se il prodotto è già presente nella variabile di sessione
function checkProductNotLogged($pid, $quantity, $color, $size) {
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd) {
            if($prd[0] == $pid && $prd[2] == $color && $prd[3] == $size) {
                $prd[1] += $quantity;
                return true;
            }
        }
        return false;
    }
    else {
        return false;
    }
}