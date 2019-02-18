<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';

//Session management procedure
session_start();

if(!isset($_SESSION['username'])) {
    if(isset($_COOKIE['userid'])){
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
        redirect("user-panel.php");
    }
    else{
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

////Controlla se è presente messaggio d'errore da mostrare
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $smarty->assign("error", "$error");
}
else {
    $error = 0;
    $smarty->assign("error", "$error");
}

//Retrive form data
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = sanitizeString($_POST['username']);
    $pass = sanitizeString($_POST['password']);
    //questo converrebbe farlo fare a javascript per poter mostrare gli errori nella stessa pagina

    $bool = checkLogin($user, $pass);
    //se il login va a buon fine indirizziamo l'utente a user-panel
    if ($bool) {
        redirect("user-panel.php");
    }
    else {
        $_SESSION['error'] = 1;
        redirect("login.php");
    }
}

$smarty->display('login.html');
unset($_SESSION['error']);


function checkLogin($user, $pass) {
    $query = "SELECT id, username, ruolo FROM cliente WHERE username = '$user' AND password = '$pass';";
    $result = queryMysql($query);
    $u = $result->fetch_row();
    
    if($result->num_rows > 0) {
        $_SESSION['userid'] = $u[0];
        $_SESSION['username'] = $u[1];
        $_SESSION['userrole'] = $u[2];

        //aggiungiamo un cookie con i dati dell'utente
        setcookie("userid", $u[0], strtotime("+1 year"));
        setcookie("username", $u[1], strtotime("+1 year"));
        setcookie("userrole", $u[2], strtotime("+1 year"));

        //riversa nel database i dati presenti nella variabile di sessione
        $userid = $u[0];
        if(isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] AS $item) {
                $product = $item[0];
                $quantity = $item[1];
                $color = $item[2];
                $size = $item[3];

                //controlliamo che il prodotto non sia già presente nel carrello
                $query = "SELECT prodotto FROM carrello WHERE cliente = '$userid' AND prodotto = '$product' AND colore = '$color' AND taglia = '$size';";
                $result = queryMysql($query);
                if($result->num_rows > 0) {
                    continue;
                }
                queryMysql("INSERT INTO carrello (cliente, prodotto, quantita, colore, taglia) VALUES ('$userid', '$product', '$quantity', '$color', '$size');");
            }
        }

        return true;
    }

    return false;
}