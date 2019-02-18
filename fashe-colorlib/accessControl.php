<?php

require_once 'function.php';

session_start();

if(!isset($_SESSION['username'])){
    if(isset($_COOKIE['userid'])){
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['userrole'] = $_COOKIE['userrole'];
    }
    else {
        $_SESSION['username'] = 'Guest';
        $_SESSION['userrole'] = 'g';
    } 
}

if (!isset($_SESSION['userid'])) {
    redirect("login.php");
}
else {
    redirect("user-panel.php");
}