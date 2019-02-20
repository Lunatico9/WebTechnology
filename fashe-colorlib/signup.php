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

//Controlla se è presente messaggio d'errore da mostrare
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $message = $_SESSION['message'];
    $smarty->assign("error", "$error");
    $smarty->assign("message", "$message");
}
else {
    $error = 0;
    $message = "";
    $smarty->assign("error", "$error");
    $smarty->assign("message", "$message");
}

//TODO aggiungere controllo sui valori inseriti (js), per ora c'è solo il required. bisogna anche controllare che password e confirm siano uguali

//Retrieve form data
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
    $user = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);
    $cpassword = sanitizeString($_POST['confirm_password']);
    $email = sanitizeString($_POST['email']);
    $data = date("Y/m/d");
    $ruolo = 'u';

    if (checkUsername($user) && checkEmail($email) && checkPassword($password, $cpassword)) {
        queryMysql("INSERT INTO cliente (username, password, email, data_pass, data_reg, ruolo) VALUES ('$user', '$password', '$email', '$data', '$data', '$ruolo');");
        
        //retrieve id and initialize session values
        $query = "SELECT id, username, ruolo FROM cliente WHERE username = '$user' AND password = '$password';";
        $result = queryMysql($query);
        $u = $result->fetch_row();

        if($result->num_rows > 0) {
            $_SESSION['userid'] = $u[0];
            $_SESSION['username'] = $u[1];
            $_SESSION['userrole'] = $u[2];

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
                unset($_SESSION['cart']);
            }
        }
    redirect('index.php');
    }
}

$smarty->display('html/signup.html');
unset($_SESSION['error']);

function checkUsername($username) {
    $query = "SELECT username FROM cliente WHERE username = '$username';";
    $result = queryMysql($query);
    $u = $result->fetch_row();

    if($result->num_rows > 0) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "This username is already taken";
        redirect("signup.php");
        return false;
    }
    return true;
}

function checkEmail($email) {
    $query = "SELECT email FROM cliente WHERE email = '$email';";
    $result = queryMysql($query);
    $u = $result->fetch_row();

    if($result->num_rows > 0) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "This email is already used.";
        redirect("signup.php");
        return false;
    }
    return true;
}

function checkPassword($password, $cpassword) {
    if($password != $cpassword) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "Passwords don't match";
        redirect("signup.php");
        return false;
    }
    return true;
}