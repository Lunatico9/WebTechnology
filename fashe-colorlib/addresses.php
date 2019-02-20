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

//intercept delete
if (isset($_POST['delete'])) {
    $userid = $_SESSION['userid'];
    $del = $_POST['delete'];
    queryMysql("UPDATE indirizzi SET eliminato = '1' WHERE alias = '$del' AND cliente = '$userid';");
}

//recuperiamo gli indirizzi dell'utente dal database
$userid = $_SESSION['userid'];
$query = "SELECT alias, nome, cognome, indirizzo, civico, citta, provincia, cap, stato FROM indirizzi WHERE cliente = '$userid' AND eliminato = '0';";
$result = queryMysql($query);
$address = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $address[] = $result->fetch_row();
    }

    $smarty->assign("addresses", $address);
    $smarty->display('html/addresses.html');
}
else {
    $smarty->display('html/addresses-empty.html');
}