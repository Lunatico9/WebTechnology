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

//costruiamo la vista per l'admin
if($_SESSION['userrole'] == 'a') {
    $smarty->assign("admin", '1');
}
else {
    $smarty->assign("admin", '0');
}

//intercept delete
if (isset($_POST['paymentid'])) {
    $userid = $_SESSION['userid'];
    $del = $_POST['paymentid'];
    $query =  "DELETE FROM metodipagamento WHERE cliente = '$userid' AND id = '$del';";
    queryMysql($query);
}

//recuperiamo i metodi di pagamento dell'utente dal database
$userid = $_SESSION['userid'];
$query = "SELECT id, nome, cognome, tipo_carta, num_carta FROM metodipagamento WHERE cliente = '$userid';";
$result = queryMysql($query);
$payment = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $payment[] = $result->fetch_row();
        $payment[$j][4] = "********* ". substr($payment[$j][4],12,strlen($payment[$j][4]));
    }

    $smarty->assign("payments", $payment);
    $smarty->display('payments.html');
}
else {
    $smarty->display('payments-empty.html');
}


