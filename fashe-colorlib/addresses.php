<?php

require_once 'libs/Smarty.class.php';
require_once 'function.php';
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

//intercept delete
if (isset($_POST['delete'])) {
    $userid = $_SESSION['userid'];
    $del = $_POST['delete'];
    $query =  "DELETE FROM indirizzi WHERE cliente = '$userid' AND alias = '$del';";
    queryMysql($query);
}

//recuperiamo gli indirizzi dell'utente dal database
$userid = $_SESSION['userid'];
$query = "SELECT alias, nome, cognome, indirizzo, civico, citta, provincia, cap, stato FROM indirizzi WHERE cliente = '$userid';";
$result = queryMysql($query);
$address = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $address[] = $result->fetch_row();
    }

    $smarty->assign("addresses", $address);
    $smarty->display('addresses.html');
}
else {
    $smarty->display('addresses-empty.html');
}