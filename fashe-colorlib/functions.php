<?php

$host = 'localhost';
$user = 'root';
$pass = "";
$name = 'tdw';

$connection = new mysqli($host, $user, $pass, $name);
if ($connection->connect_error) die($connection->connect_error);

/**
* Connette al database ed effettua la query
*/
function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

/**
* Ripulisce le stringhe da elementi dannosi
*/
function sanitizeString($var) {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    $var = str_replace("'", "\\'", $var);
    return $var;
}

/**
* Reindirizza alla pagina richiesta
*/
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    exit();
}

/**
* Gestisce la sessione per le pagina esterna
*/
function sessionManager() {
    session_start();

    if(!isset($_SESSION['userid'])) {
        if(isset($_COOKIE['userid'])) {
            $_SESSION['userid'] = $_COOKIE['userid'];
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['userrole'] = $_COOKIE['userrole'];
        }
        else {
            $_SESSION['username'] = 'Guest';
            $_SESSION['userrole'] = 'g';
        } 
    }
}

/**
* Gestisce la sessione per le pagine interne
*/
function sessionManagerRestricted() {
    session_start();
    
    if(!isset($_SESSION['userid'])){
        if(isset($_COOKIE['userid'])){
            $_SESSION['userid'] = $_COOKIE['userid'];
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['userrole'] = $_COOKIE['userrole'];
        }
        else {
            redirect("login.php");
        } 
    }
}

