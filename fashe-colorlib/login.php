<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/userdao.php';

//Session management procedure
sessionManager();

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

    $bool = checkUser($user, $pass);
    //se il login va a buon fine indirizziamo l'utente a user-panel
    if ($bool) {
        redirect("user-panel.php");
    }
    else {
        $_SESSION['error'] = 1;
        redirect("login.php");
    }
}

$smarty->display('html/login.html');
unset($_SESSION['error']);


function checkUser($user, $pass) {
    $result = CheckLogin($user, $pass);
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
                $result = checkCartProduct($userid, $product, $color, $size);
                if($result->num_rows > 0) {
                    continue;
                }
                addProductToCart($userid, $product, $quantity, $color, $size);
            }
            unset($_SESSION['cart']);
        }

        return true;
    }

    return false;
}