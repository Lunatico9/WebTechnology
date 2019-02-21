<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/productdao.php';


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

//Popola category options
$category = getCategories();

$smarty->assign("categories", $category);

//Popola catalogue options
$catalogue = getCatalogues();

$smarty->assign("catalogues", $catalogue);

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


    if($_FILES['userfile']['name'][0] == "" || !isset($_FILES['userfile']['name'][0])) {
        $img1 = 0; //l'immagine non sarà salvata
        
        //controlliamo se esiste già un prodotto con il nome indicato, se non esiste non possiamo permettere
        //venga creato senza un'immagine
        if(!checkProductName($name)) {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = "This product doesn't exist yet, add an image to create it";
            redirect('add-product.php');
            $img1 = 0;
        }
    }
    else {
        $img1 = saveImage(0);
    }
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

        $pid = 0;
        //controlliamo se il nome sia già presente, nel caso aggiungiamo solamente in colore e taglia
        if(!checkProductName($name)) {
            addProduct($name, $desc, $detdesc, $price, $category, $catalogue);

            //recuperiamo l'id appena creato
            $pid = getLastID();
        }
        else {
            $pid = getProductID($name);
        }

        //controlliamo se la coppia prodotto-colore sia già presente
        if (checkColor($pid, $color)) {
            addColor($pid, $color);
        }

        //controlliamo se la coppia prodotto-taglia sia già presente
        if (checkSize($pid, $size)) {
            addSize($pid, $size);
        }
        
        addAvailability($pid, $color, $size, $availability);
        
        if($img1) {
            $path1 = "images/". $_FILES['userfile']['name'][0];
            addImage($path1, $pid, 1);
        }
    
        if($img2) {
            $path2 = "images/". $_FILES['userfile']['name'][1];
            addImage($path2, $pid, 0);
        }

        if($img3) {
            $path3 = "images/". $_FILES['userfile']['name'][2];
            addImage($path2, $pid, 0);
        }
    }
    else {
        //lo fa già checkProduct ma per chiarezza aggiungo anche qui
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "This product already exists";
        redirect('add-product.php');
    }
}


$smarty->display('html/add-product.html');
unset($_SESSION['error']);
unset($_SESSION['message']);



/**
 * Salva l'immagine nel server
 */
function saveImage($j) {
    $target_dir = "/wamp64/www/images/";
    $target = $target_dir . $_FILES["userfile"]["name"][$j];
    
    move_uploaded_file($_FILES["userfile"]["tmp_name"][$j], $target);
    return 1;
}

/** 
* Controlliamo se il prodotto esista già
*/
function checkProduct($name, $color, $size) {
    $result = checkProductDao($name, $color, $size);
    
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

/** 
* Controlliamo se il nome del prodotto sia già presente nel db, 
* restituisce 1 se presente, 0 altrimenti
*/
function checkProductName($name) {
    $pid = getProductID($name);
    
    if($pid == null) {
        return 0;
    }
    else {
        return 1;
    }
}