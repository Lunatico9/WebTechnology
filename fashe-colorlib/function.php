<?php

$host = 'localhost';
$user = 'root';
$pass = "";
$name = 'tdw';

$connection = new mysqli($host, $user, $pass, $name);
if ($connection->connect_error) die($connection->connect_error);

function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    exit();
}
