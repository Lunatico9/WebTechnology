<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/userdao.php';


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
    deletePaymentMethod($del);
}

//recuperiamo i metodi di pagamento dell'utente dal database
$userid = $_SESSION['userid'];
$result = getPaymentMethods($userid);
$payment = array();
    
if ($result->num_rows > 0) {
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $payment[] = $result->fetch_row();
        $payment[$j][4] = "********* ". substr($payment[$j][4],12,strlen($payment[$j][4]));
    }

    $smarty->assign("payments", $payment);
    $smarty->display('html/payments.html');
}
else {
    $smarty->display('html/payments-empty.html');
}


