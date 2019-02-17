<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
require_once 'header.php';


//Session management procedure
session_start();

if(!isset($_SESSION['username'])) {
    if(isset($_COOKIE['userid'])) {
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        redirect("login.php");
    }
}

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
    $smarty->assign("error", "$error");
}
else {
    $error = 0;
    $smarty->assign("error", "$error");
}


//Retrieve form data
if(isset($_REQUEST['address-name']) && isset($_REQUEST['name']) && isset($_REQUEST['surname']) && isset($_REQUEST['address']) && isset($_REQUEST['civ']) && isset($_REQUEST['city']) && isset($_REQUEST['region']) && isset($_REQUEST['cap']) && isset($_REQUEST['country'])) {
    $userid = $_SESSION['userid'];
    
    $alias = sanitizeString($_REQUEST['address-name']);
    //controlliamo che il cliente non abbia già un indirizzo salvato sotto il nuovo alias
    if(checkAlias($alias)) {
        $name = sanitizeString($_REQUEST['name']);
        $surname = sanitizeString($_REQUEST['surname']);
        $add = sanitizeString($_REQUEST['address']);
        $civ = sanitizeString($_REQUEST['civ']);
        $city = sanitizeString($_REQUEST['city']);
        $reg = sanitizeString($_REQUEST['region']);
        $cap = sanitizeString($_REQUEST['cap']);
        $country = sanitizeString($_REQUEST['country']);

        queryMysql("INSERT INTO indirizzi (alias, cliente, nome, cognome, indirizzo, civico, citta, provincia, cap, stato) VALUES ('$alias', '$userid', '$name', '$surname', '$add', '$civ', '$city', '$reg' , '$cap', '$country');");
        redirect('addresses.php');
    }
}

$smarty->display('add-address.html');
unset($_SESSION['error']);

function checkAlias($newalias) {
    $userid = $_SESSION['userid'];
    $query = "SELECT alias FROM indirizzi WHERE alias = '$newalias' AND cliente = '$userid';";
    $result = queryMysql($query);
    $u = $result->fetch_row();

    if($result->num_rows > 0) {
        $_SESSION['error'] = 1;
        redirect('add-address.php');
        return false;
    }
    return true;
}