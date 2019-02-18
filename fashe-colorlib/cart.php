<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['username'])){
    if(isset($_COOKIE['userid'])){
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        $_SESSION['username'] = 'Guest';
        $_SESSION['userrole'] = 'g';
    } 
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
    $query =  "DELETE FROM carrello WHERE carrello.cliente = '$userid' AND carrello.prodotto = (SELECT id FROM prodotto WHERE prodotto.nome = '$del');";
    queryMysql($query);
}

//Retrieve cart
$date = date('Y m d');

//Controlla se l'utente ha effettuato il login, se non lo ha effettuato costruiamo la view del carrello 
//con i dati presenti nella variabile di sessione
if(!isset($_SESSION['userid'])) {
    $i = 0;

    if(isset($_SESSION['cart'])) {
        $products = array();

        foreach ($_SESSION['cart'] AS $item) {
            $pid = $item[0];
            $quantity = $item[1];
            $color = $item[2];
            $size = $item[3];
            //recuperiamo gli altri dati che ci servono per popolare il carrello
            $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE prodotto.id = '$pid' AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
            $result = queryMysql($query);
            $u = $result->fetch_row();
    
            //costruiamo gli array contenenti i prodotti in maniera consistente con l'altro caso per non avere problemi con la visualizzazione
            $product = array($u[0], $u[1], $u[2], $quantity, $u[3], $color, $size, $i);
            $i++;
            $products[] = $product;
        }

        $smarty->assign("products", $products);
        $smarty->display('cart.html');
    }
    else {
        $smarty->display('cart-empty.html');
    }
}
//nel caso in cui il cliente è loggato estraiamo dal database i dati sui prodotti presenti nel carrello
else {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, carrello.quantita, prodottoscontato.prezzo, carrello.colore, carrello.taglia FROM carrello, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio > '$date' WHERE carrello.cliente = '$userid' AND prodotto.id = carrello.prodotto AND immagine.prodotto = carrello.prodotto AND immagine.principale = 1;";
    $result = queryMysql($query);
    $product = array();

    if ($result->num_rows > 0) {
        for ($j = 0; $j < $result->num_rows; ++$j) {
            $result->data_seek($j);
            $product[] = $result->fetch_row();
            $product[$j][7] = $j;
        }

        $smarty->assign("products", $product);
        $smarty->display('cart.html');
    }

    else  {
        $smarty->display('cart-empty.html');
    }
}



