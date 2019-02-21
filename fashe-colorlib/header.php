<?php

require_once 'dao/userdao.php';

/**
* Restituisce i valori da inserire nell'header
*/
function headerValues() {
    $values = array(0, "Guest");
    
    //number of item in the cart value
    if (isset($_SESSION['userid'])){
        $items = cartItems($_SESSION['userid']);
        $values[0] = $items;
    }
    else {
        if(isset($_SESSION['cart'])) {
            $i = 0;
            foreach ($_SESSION['cart'] AS $item) {
                $i++;
            }
            $values[0] = $i;
        }
    }
    //username value
    $username = $_SESSION['username'];
    $values[1] = $username;
    return $values;
}

/**
* Restituisce numero di oggetti nel carrello
*/
function cartItems($id) {
    $result = getCart($id);
    return $result->num_rows;
}