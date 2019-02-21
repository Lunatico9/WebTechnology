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

    if (checkUser($user) && checkEmail($email) && checkPassword($password, $cpassword)) {
        addUser($user, $password, $email, $data, $ruolo);
        
        //retrieve id and initialize session values
        $result = checkLogin($username, $password);
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
                    $result = checkCartProduct($userid, $product, $color, $size);
                    if($result->num_rows > 0) {
                        continue;
                    }
                    addProductToCart($userid, $product, $quantity, $color, $size);
                }
                unset($_SESSION['cart']);
            }
        }
    redirect('index.php');
    }
}

$smarty->display('html/signup.html');
unset($_SESSION['error']);

function checkUser($username) {
    $result = checkUsername($username);
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
    $result = checkMail($email);
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