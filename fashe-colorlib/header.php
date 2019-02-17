<?php

function headerValues(){

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

function cartItems($id)
{
    $query2 = "SELECT carrello.prodotto FROM carrello WHERE carrello.cliente = '$id'";
    $result = queryMysql($query2);
    return $result->num_rows;
}