<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';


//Session management procedure
sessionManagerRestricted();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}

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
if(isset($_POST['address-name']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['address']) && isset($_POST['civ']) && isset($_POST['city']) && isset($_POST['region']) && isset($_POST['cap']) && isset($_POST['country'])) {
    $userid = $_SESSION['userid'];
    
    $alias = sanitizeString($_POST['address-name']);
    $alias = str_replace("'", " ", $alias);

    //controlliamo che il cliente non abbia già un indirizzo salvato sotto il nuovo alias
    if(checkAlias($alias)) {
        $name = sanitizeString($_POST['name']);
        $surname = sanitizeString($_POST['surname']);
        $add = sanitizeString($_POST['address']);
        $civ = sanitizeString($_POST['civ']);
        $city = sanitizeString($_POST['city']);
        $reg = sanitizeString($_POST['region']);
        $cap = sanitizeString($_POST['cap']);
        $country = sanitizeString($_POST['country']);

        queryMysql("INSERT INTO indirizzi (alias, cliente, nome, cognome, indirizzo, civico, citta, provincia, cap, stato) VALUES ('$alias', '$userid', '$name', '$surname', '$add', '$civ', '$city', '$reg', '$cap', '$country');");
        redirect('addresses.php');
    }
}

$smarty->display('html/add-address.html');
unset($_SESSION['error']);

//controlla che l'alias fornito non sia già presente nel database per l'utente corrente
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