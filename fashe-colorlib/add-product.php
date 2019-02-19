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

//Popola category options
$query = "SELECT id, nome FROM categoria;";
$result = queryMysql($query);
$category = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $category[] = $result->fetch_row();
}

$smarty->assign("categories", $category);

//Popola catalogue options
$query = "SELECT id, nome FROM catalogo;";
$result = queryMysql($query);
$catalogue = array();

for ($j = 0; $j < $result->num_rows; ++$j) {
    $result->data_seek($j);
    $catalogue[] = $result->fetch_row();
}

$smarty->assign("catalogues", $catalogue);

//Controlla se è presente messaggio d'errore da mostrare
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $message = $_SESSION['message'];
    $smarty->assign("error", "$error");
    $smarty->assign("message", "$message");
}
else {
    $error = 0;
    $message = "";
    $smarty->assign("error", "$error");
    $smarty->assign("message", "$message");
}

//Retrieve form data
if(isset($_POST['name']) && isset($_POST['color']) && isset($_POST['size']) && isset($_POST['price']) && isset($_POST['availability']) && isset($_POST['description']) && isset($_POST['detailed-description']) && isset($_POST['category']) && isset($_POST['catalogue']) && isset($_FILES['userfile'])) {
    $name = sanitizeString($_POST['name']);
    $color = sanitizeString($_POST['color']);
    $size = sanitizeString($_POST['size']);
    $price = sanitizeString($_POST['price']);
    $desc = sanitizeString($_POST['description']);
    $detdesc = sanitizeString($_POST['detailed-description']);
    $availability = sanitizeString($_POST['availability']);
    $category = sanitizeString($_POST['category']);
    $catalogue = sanitizeString($_POST['catalogue']);

    $img1 = saveImage(0);

    if($_FILES['userfile']['name'][1] != "") {
        $img2 = saveImage(1);
    }
    else {
        $img2 = 0;
    }

    if($_FILES['userfile']['name'][2] != "") {
        $img3 = saveImage(2);
    }
    else {
        $img3 = 0;
    }

    //controlliamo se prodotto con stesso nome, colore e taglia esista già
    if(checkProduct($name, $color, $size)) {
        //controlliamo se il nome sia già presente, nel caso aggiungiamo solamente in colore e taglia
        $pid = checkProductName($name);
        if($pid == 0) {
            queryMysql("INSERT INTO prodotto (nome, desc_breve, desc_dett, prezzo, categoria, catalogo) VALUES ('$name', '$desc', '$detdesc', '$price', '$category', '$catalogue');");

            //recuperiamo l'id appena creato
            $query = "SELECT LAST_INSERT_ID();";
            $result = queryMysql($query);
            $product = $result->fetch_row();
            $pid = $product[0];
        }

        queryMysql("INSERT INTO colore (colore, prodotto) VALUES ('$color', '$pid');");
        queryMysql("INSERT INTO taglia (taglia, prodotto) VALUES ('$size', '$pid');");
        queryMysql("INSERT INTO magazzino (prodotto, colore, taglia, disponibilita) VALUES ('$pid', '$color', '$size', '$availability');");
        
        $path1 = "images/". $_FILES['userfile']['name'][0];
        queryMysql("INSERT INTO immagine (path, prodotto, principale) VALUES ('$path1', '$pid', '1');");
    
        if($img2) {
            $path2 = "images/". $_FILES['userfile']['name'][1];
            queryMysql("INSERT INTO immagine (path, prodotto, principale) VALUES ('$path2', '$pid', '0');");
        }

        if($img3) {
            $path3 = "images/". $_FILES['userfile']['name'][2];
            queryMysql("INSERT INTO immagine (path, prodotto, principale) VALUES ('$path3', '$pid', '0');");
        }
    }
}


$smarty->display('add-product.html');
unset($_SESSION['error']);
unset($_SESSION['message']);



//salva l'immagine nel server
function saveImage($j) {
    $target_dir = "/wamp64/www/images/";
    $target = $target_dir . $_FILES["userfile"]["name"][$j];
    
    move_uploaded_file($_FILES["userfile"]["tmp_name"][$j], $target);
    return 1;
}

//controlliamo se il prodotto esista già
function checkProduct($name, $color, $size) {
    $query = "SELECT prodotto.nome, colore.colore, taglia.taglia FROM prodotto, colore, taglia WHERE prodotto.id = colore.prodotto AND prodotto.id = taglia.prodotto AND prodotto.nome = '$name' AND colore.colore = '$color' AND taglia.taglia = '$size';";
    $result = queryMysql($query);
    
    if($result->num_rows > 0) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "This product already exists";
        redirect('add-product.php');
    }
    else {
        return 1;
    }

    return 0;
}

//controlliamo se il nome del prodotto sia già presente nel db, 
//restituisce l'id del prodotto se presente, 0 altrimenti
function checkProductName($name) {
    $query = "SELECT id FROM prodotto WHERE prodotto.nome = '$name';";
    $result = queryMysql($query);
    
    if($result->num_rows > 0) {
        $pid = $result->fetch_row();
        return $pid[0];
    }
    else {
        return 0;
    }
}