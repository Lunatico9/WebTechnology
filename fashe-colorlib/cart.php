<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';

//Session management procedure
sessionManager();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//Retrieve cart
$date = str_replace(" ", "", date('Y m d'));

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
            $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = '$pid' AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
            $result = queryMysql($query);
            $u = $result->fetch_row();
    
            //costruiamo gli array contenenti i prodotti in maniera consistente con l'altro caso per non avere problemi con la visualizzazione
            $product = array($u[0], $u[1], $u[2], $quantity, $u[3], $color, $size, $i);
            $i++;
            $products[] = $product;
        }

        $smarty->assign("products", $products);
        $smarty->display('html/cart.html');
    }
    else {
        $smarty->display('html/cart-empty.html');
    }
}
//nel caso in cui il cliente è loggato estraiamo dal database i dati sui prodotti presenti nel carrello
else {
    $userid = $_SESSION['userid'];
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, carrello.quantita, prodottoscontato.prezzo, carrello.colore, carrello.taglia FROM carrello, immagine, prodotto LEFT OUTER JOIN prodottoscontato ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' AND prodottoscontato.data_fine > '$date' WHERE carrello.cliente = '$userid' AND prodotto.id = carrello.prodotto AND immagine.prodotto = carrello.prodotto AND immagine.principale = 1 ORDER BY prodotto.id;";
    $result = queryMysql($query);
    $product = array();

    if ($result->num_rows > 0) {
        for ($j = 0; $j < $result->num_rows; ++$j) {
            $result->data_seek($j);
            $product[] = $result->fetch_row();
            $product[$j][7] = $j;
        }

        $smarty->assign("products", $product);
        $smarty->display('html/cart.html');
    }

    else  {
        $smarty->display('html/cart-empty.html');
    }
}

//intercept update
if (isset($_POST['update'])) {
    $quantities = $_POST['quantities'];

    if(!isset($_SESSION['userid'])) {
        $i = 0;
        foreach ($_SESSION['cart'] AS &$item) {
            if ($quantities[$i] == 0) {
                unset($_SESSION['cart'][$i]);
            }
            else {
                $item[1] = $quantities[$i];
            }
            $i++;
        }
    }
    else {
        //recuperiamo gli oggetti dal carrello dell'utente
        $userid = $_SESSION['userid'];
        $query = "SELECT prodotto, quantita, colore, taglia FROM carrello WHERE cliente = '$userid';";
        $result = queryMysql($query);
        if ($result->num_rows > 0) {
            for ($j = 0; $j < $result->num_rows; $j++) {
                $result->data_seek($j);
                $product = $result->fetch_row();

                //controlliamo se la quantità è cambiata
                if($product[1] == $quantities[$j]) {
                    continue;
                }
                elseif($quantities[$j] == 0) {
                    deleteProduct($userid, $product[0]);
                }
                else {
                    if(checkAvailability($product[0], $quantities[$j], $product[2], $product[3])) {
                        updateProduct($userid, $product[0], $quantities[$j], $product[2], $product[3]);
                    }
                }
            }
        }
    }
}

//elimina il prodotto dal carrello
function deleteProduct($userid, $pid) {
    queryMysql("DELETE FROM carrello WHERE cliente = '$userid' AND prodotto = '$pid';");
}

//aggiorna la quantità del prodotto nel carrello
function updateProduct($userid, $pid, $quantity, $color, $size) {
    queryMysql("UPDATE carrello SET quantita = '$quantity' WHERE cliente = '$userid' AND prodotto = '$pid' AND colore = '$color' AND taglia = '$size';");
}

//controlliamo che la disponibilità del prodotto sia maggiore della quantità richiesta
function checkAvailability($pid, $quantity, $color, $size) {
    $query = "SELECT disponibilita FROM magazzino WHERE prodotto = '$pid' AND colore = '$color' AND taglia = '$size';";
    $result = queryMysql($query);
    $availability = $result->fetch_row();

    if($quantity > $availability[0]) {
        echo "over";
        return 0;
    }
    
    return 1;
}