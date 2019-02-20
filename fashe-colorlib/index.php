<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';

//Session management procedure
sessionManager();

$smarty = new Smarty;

//Header values
$values = headerValues();
$items = $values[0];
$username = $values[1];

$smarty->assign("items", "$items");
$smarty->assign("user", "$username");

//Popoliamo le vetrine nella home in maniera dinamica

//Best Seller values
$query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path FROM evidenzia, vetrina, prodotto, immagine WHERE immagine.prodotto = prodotto.id AND immagine.principale = '1' AND vetrina.nome = 'Best Seller' AND vetrina.id = evidenzia.vetrina AND prodotto.id = evidenzia.prodotto;";
$result = queryMysql($query);

for ($j = 0 ; $j < $result->num_rows; ++$j)
{
    $result->data_seek($j);
    $product = $result->fetch_row();
    $smarty->assign("product"."$j", "$product[0]");
    $smarty->assign("price"."$j", "$product[1]");
    $smarty->assign("img"."$j", "$product[2]");
}

//On Sale values
$query = "SELECT prodotto.nome, prodotto.prezzo, prodottoscontato.prezzo, immagine.path FROM evidenzia, vetrina, prodotto, immagine, prodottoscontato WHERE immagine.prodotto = prodotto.id AND immagine.principale = '1' AND vetrina.nome = 'On Sale' AND vetrina.id = evidenzia.vetrina AND prodotto.id = evidenzia.prodotto AND prodotto.id = prodottoscontato.prodotto;";
$result = queryMysql($query);

for ($j = 0 ; $j < $result->num_rows; ++$j)
{
    $result->data_seek($j);
    $product = $result->fetch_row();
    $smarty->assign("saleproduct"."$j", "$product[0]");
    $smarty->assign("oldprice"."$j", "$product[1]");
    $smarty->assign("newprice"."$j", "$product[2]");
    $smarty->assign("saleimg"."$j", "$product[3]");
}

$smarty->display('index.html');