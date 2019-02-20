<?php

require_once 'functions.php';

session_start();

//elimina la sessione
session_destroy();
//cancella i dati nella variable
$_SESSION = array();

//elimina il cookie con i dati dell'utente
setcookie("userid", "", 0);
unset($_COOKIE['userid']);
setcookie("username", "", 0);
unset($_COOKIE['username']);
setcookie("userrole", "", 0);
unset($_COOKIE['userrole']);

redirect("index.php");
