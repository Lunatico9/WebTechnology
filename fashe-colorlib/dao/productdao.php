<?php

require_once 'functions.php';

/**
 * Implementa funzione del DBMS che permette di ottenere l'ultimo id generato
 */
function getLastID() {
    $query = "SELECT LAST_INSERT_ID();";
    $result = queryMysql($query);
    $product = $result->fetch_row();
    return $product[0];
}


//PRODOTTO

/**
 * Restituisce tutti i prodotti
 */
function searchProduct($min, $max, $sorting) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio <= '$date' 
              AND prodottoscontato.data_fine >= '$date' WHERE prodotto.id = immagine.prodotto 
              AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' 
              ORDER BY $sorting;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti che fanno match con la stringa in input
 */
function searchProductByName($str, $min, $max, $sorting) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio <= '$date' 
              AND prodottoscontato.data_fine >= '$date' WHERE prodotto.id = immagine.prodotto 
              AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' 
              AND prodotto.nome LIKE '%$str%' ORDER BY $sorting;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti afferenti ad una categoria
 */
function searchProductByCatalogue($catalogue, $min, $max, $sorting) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio <= '$date' 
              AND prodottoscontato.data_fine >= '$date' WHERE prodotto.id = immagine.prodotto 
              AND immagine.principale = 1 AND prodotto.prezzo >= '$min' AND prodotto.prezzo <= '$max' 
              AND prodotto.catalogo = (SELECT id FROM catalogo WHERE catalogo.nome = '$catalogue' 
              ORDER BY $sorting);";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti afferenti ad una categoria
 */
function searchProductByCategory($category, $min, $max, $sorting) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio <= '$date' 
              AND prodottoscontato.data_fine >= '$date' WHERE prodotto.id = immagine.prodotto 
              AND immagine.principale = 1 AND prodotto.categoria = 
              (SELECT categoria.id FROM categoria WHERE categoria.nome = '$category' ORDER BY $sorting);";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce tutti i prodotti in sconto
 */
function SearchOnSale($min, $max, $sorting) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto, prodottoscontato WHERE prodotto.id = prodottoscontato.prodotto 
              AND prodottoscontato.data_inizio <= '$date' AND prodottoscontato.data_fine >= '$date' 
              AND prodotto.id = immagine.prodotto AND prodottoscontato.prezzo >= '$min' 
              AND prodottoscontato.prezzo <= '$max' AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiunge prodotto al database
 */
function addProduct($name, $desc, $detdesc, $price, $category, $catalogue) {
    queryMysql("INSERT INTO prodotto (nome, desc_breve, desc_dett, prezzo, categoria, catalogo) 
                VALUES ('$name', '$desc', '$detdesc', '$price', '$category', '$catalogue');");
}

/**
 * Restituisce prodotto e prezzo scontato
 */
function getProduct($name) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.desc_breve, prodotto.desc_dett, prodotto.prezzo, 
              prodottoscontato.prezzo FROM prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' WHERE prodotto.nome = '$name';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce id di un prodotto
 */
function getProductID($name) {
    $query = "SELECT id FROM prodotto WHERE prodotto.nome = '$name';";
    $result = queryMysql($query);
    $pid = $result->fetch_row();
    return $pid[0];
}

/**
 * Restituisce prodotto con combinazione nome-colore-taglia se esiste nel database
 */
function checkProductDao($name, $color, $size) {
    $query = "SELECT prodotto.nome, colore.colore, taglia.taglia FROM prodotto, colore, taglia 
              WHERE prodotto.id = colore.prodotto AND prodotto.id = taglia.prodotto 
              AND prodotto.nome = '$name' AND colore.colore = '$color' AND taglia.taglia = '$size';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce informazioni per costruire pagina prodotto
 */
function getProductsInfo($pid, $date) {
    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' WHERE prodotto.id = '$pid' 
              AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce categoria e catalogo di un prodotto
 */
function getProductPath($name) {
    $query = "SELECT catalogo.nome, categoria.nome, prodotto.nome FROM prodotto, categoria, catalogo 
              WHERE catalogo.id = (SELECT prodotto.catalogo FROM prodotto WHERE prodotto.nome = '$name') 
              AND categoria.id = (SELECT prodotto.categoria FROM prodotto WHERE prodotto.nome = '$name') 
              AND prodotto.nome = '$name';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiunge coppia prodotto-colore al database
 */
function addColor($pid, $color) {
    queryMysql("INSERT INTO colore (colore, prodotto) VALUES ('$color', '$pid');");
}

/**
 * Restituisce colori disponibili di un prodotto
 */
function getColor($name) {
    $query = "SELECT colore.colore FROM prodotto, colore 
              WHERE prodotto.nome = '$name' AND prodotto.id = colore.prodotto;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Controlla se la coppia prodotto-colore è presente nel database,
 * restituisce 1 se non c'è, 0 altrimenti
 */
function checkColor($pid, $color) {
    $query = "SELECT colore FROM colore WHERE prodotto = '$pid' AND colore = '$color';";
    $result = queryMysql($query);
    if($result->num_rows == 0) {
        return 1;
    }
    else return 0;
}

/**
 * Aggiunge coppia prodotto-taglia al database
 */
function addSize($pid, $size) {
    queryMysql("INSERT INTO taglia (taglia, prodotto) VALUES ('$size', '$pid');");
}
 
/**
 * Restituisce taglie disponibili di un prodotto
 */
function getSize($name) {
    $query = "SELECT taglia.taglia FROM prodotto, taglia 
              WHERE prodotto.nome = '$name' AND prodotto.id = taglia.prodotto;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Controlla se la coppia prodotto-taglia è presente nel database,
 * restituisce 1 se non c'è, 0 altrimenti
 */
function checkSize($pid, $size) {
    $query = "SELECT taglia FROM taglia WHERE prodotto = '$pid' AND taglia = '$size';";
    $result = queryMysql($query);
    if($result->num_rows == 0) {
        return 1;
    }
    else return 0;
}

/**
 * Aggiunge disponibilità di un prodotto in magazzino
 */
function addAvailability($pid, $color, $size, $availability) {
    queryMysql("INSERT INTO magazzino (prodotto, colore, taglia, disponibilita) 
                VALUES ('$pid', '$color', '$size', '$availability');");
}

/**
 * Restituisce disponibilità di un prodotto
 */
function getAvailability($pid, $color, $size) {
    $query = "SELECT disponibilita FROM magazzino 
              WHERE prodotto = '$pid' AND colore = '$color' AND taglia = '$size';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce disponibilità di un prodotto
 */
function getAvailabilityTemp($pid) {
    $query = "SELECT disponibilita FROM magazzino WHERE prodotto = '$pid';";
    $result = queryMysql($query);
    return $result;
}

/**
 * Aggiorna la disponibilità in magazzino del prodotto
 */
function updateAvailability($id, $newAvailability, $color, $size) {
    queryMysql("UPDATE magazzino SET disponibilita = '$newAvailability' 
                WHERE prodotto = '$id' AND colore = '$color' AND taglia = '$size';");
}

/**
 * Aggiunge un immagine per un prodotto
 */
function addImage($path, $pid, $main) {
    queryMysql("INSERT INTO immagine (path, prodotto, principale) 
                VALUES ('$path', '$pid', '$main');");
}

/**
 * Restituisce tutte le immagini di un dato prodotto
 */
function getImages($name) {
    $query = "SELECT immagine.path FROM immagine, prodotto 
              WHERE prodotto.nome = '$name' AND prodotto.id = immagine.prodotto";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce i prodotti che hanno categoria in comune col prodotto dato
 */
function getCategoryRelatedProducts($name, $category) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM categoria, immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' 
              WHERE categoria.nome = '$category' AND prodotto.nome != '$name' 
              AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}

/**
 * Restituisce i prodotti che hanno catalogo comune col prodotto dato
 */
function getCatalogueRelatedProducts($name, $catalogue) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM catalogo, immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' WHERE catalogo.nome = '$catalogue' 
              AND prodotto.nome != '$name' AND immagine.prodotto = prodotto.id AND immagine.principale = 1;";
    $result = queryMysql($query);
    return $result;
}


/**
 * Aggiunge sconto ad un prodotto
 */
function addSale($pid, $start, $end, $price) {
    queryMysql("INSERT INTO prodottoscontato (prodotto, data_inizio, data_fine, prezzo) 
                VALUES ('$pid', '$start', '$end', '$price');");
}


//CATEGORIE

/**
 * Restituisce tutte le categorie
 */
function getCategories() {
    $query = "SELECT id, nome FROM categoria;";
    $result = queryMysql($query);
    $category = array();

    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $category[] = $result->fetch_row();
    }

    return $category;
}

/**
 * Restituisce tutti i cataloghi
 */
function getCatalogues() {
    $query = "SELECT id, nome FROM catalogo;";
    $result = queryMysql($query);
    $catalogue = array();

    for ($j = 0; $j < $result->num_rows; ++$j) {
        $result->data_seek($j);
        $catalogue[] = $result->fetch_row();
    }

    return $catalogue;
}


// VETRINE

/**
 * Restituisce i prodotti presenti in una vetrina
 */
function getWindowProducts($window) {
    $date = str_replace(" ", "", date('Y m d'));

    $query = "SELECT prodotto.nome, prodotto.prezzo, immagine.path, prodottoscontato.prezzo 
              FROM evidenzia, vetrina, immagine, prodotto LEFT OUTER JOIN prodottoscontato 
              ON prodotto.id = prodottoscontato.prodotto AND prodottoscontato.data_inizio < '$date' 
              AND prodottoscontato.data_fine > '$date' WHERE immagine.prodotto = prodotto.id 
              AND immagine.principale = '1' AND vetrina.nome = '$window' AND vetrina.id = evidenzia.vetrina 
              AND prodotto.id = evidenzia.prodotto;";
    $result = queryMysql($query);
    return $result;
}
