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
if (isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['confirmpass'])) {
    $oldpass = sanitizeString($_POST['oldpass']);
    $newpass = sanitizeString($_POST['newpass']);
    $confirmpass = sanitizeString($_POST['confirmpass']);

    if (checkOldPassword($oldpass) && checkNewPasswords($newpass, $confirmpass)) {
        $userid = $_SESSION['userid'];
        queryMysql("UPDATE cliente SET password = '$newpass' WHERE id = '$userid';");
        redirect('user-panel.php');
    }
}

$smarty->display('html/edit-password.html');
unset($_SESSION['error']);

function checkOldPassword($oldpass) {
    $username = $_SESSION['username'];
    $query = "SELECT username FROM cliente WHERE password = '$oldpass' AND username = '$username';";
    $result = queryMysql($query);
    $u = $result->fetch_row();

    if($result->num_rows == 0) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "Actual password isn't correct";
        redirect("edit-password.php");
        return false;
    }
    return true;
}

function checkNewPasswords($newpass, $confirmpass) {
    if($newpass != $confirmpass) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = "New passwords don't match";
        redirect("edit-password.php");
        return false;
    }
    return true;
}