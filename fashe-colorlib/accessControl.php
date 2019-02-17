<?php

require_once 'function.php';

session_start();

if(isset($_COOKIE['userid'])){
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['userrole'] = $_COOKIE['userrole'];
}

if(!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'Guest';
    $_SESSION['userrole'] = 'g';
}

if ($_SESSION['userrole'] == 'g') {
    redirect("login.php");
}
else {
    redirect("user-panel.php");
}