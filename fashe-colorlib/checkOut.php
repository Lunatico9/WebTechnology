<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/userdao.php';
require_once 'dao/productdao.php';
require_once 'dao/orderdao.php';

//Session management procedure
sessionManagerRestricted();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

$userid = $_SESSION['userid'];

//recupero total tramite jquery
$total = $_POST['total'];
$smarty->assign("total", $total);

//Popola address options
$result = getAddresses($userid);
$address = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $address[] = $result->fetch_row();
}

$smarty->assign("addresses", $address);

//Populate payment options
$result = getPaymentMethods($userid);
$payment = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $payment[] = $result->fetch_row();
    $payment[$j][4] = "********* ". substr($payment[$j][4],12,strlen($payment[$j][4]));
}

$smarty->assign("payments", $payment);

//Populate courier options
$result = getCouriers();
$courier = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $courier[] = $result->fetch_row();
}

$smarty->assign("deloptions", $courier);

//Intercettiamo la conferma dell'ordine
if(isset($_POST['address']) && isset($_POST['payment']) && isset($_POST['courier'])) {
    $total = $_POST['total'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    $courier = $_POST['courier'];

    $status = "Received";
    $date = str_replace(" ", "", date('Y m d'));

    //inseriamo l'ordine nel db
    addOrder($userid, $status, $address, $total);

    //recuperiamo l'id appena creato
    $orderid = getLastID();

    //inseriamo il pagamento e la spedizione nel db
    addPayment($orderid, $payment, $status);
    addShipping($orderid, $courier, $status);

    //recuperiamo i prodotti dal carrello
    $result = getCartProductsForOrders($userid, $date);
    $product = array();
    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $product[] = $result->fetch_row();

        $id = $product[$j][0];
        $quantity = $product[$j][1];
        $color = $product[$j][2];
        $size = $product[$j][3];
        
        //se il prodotto è scontato inseriamo il prezzo scontato, altrimenti il prezzo normale
        if(isset($product[$j][5])) {
            $price = $product[$j][5];
            addBoughtProduct($orderid, $id, $quantity, $color, $size, $price);
        }
        else {
            $price = $product[$j][4];
            addBoughtProduct($orderid, $id, $quantity, $color, $size, $price);
        }

        //togliamo dalla disponibilità del prodotto la quantità acquistata
        $result1 = getAvailability($id, $color, $size);
        $availability = $result1->fetch_row();

        $newAvailability = $availability[0] - $quantity;

        updateAvailability($id, $newAvailability, $color, $size);
    }
    //eliminiamo tutti i prodotti dal carrello
    deleteCart($userid);
}

$smarty->display('html/checkout.html');