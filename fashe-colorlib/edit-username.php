<?php

require_once 'libs/Smarty.class.php';
require_once 'functions.php';
require_once 'header.php';
require_once 'dao/userdao.php';


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

////Controlla se è presente messaggio d'errore da mostrare
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    $smarty->assign("error", "$error");
}
else {
    $error = 0;
    $smarty->assign("error", "$error");
}

if(isset($_POST['username'])) {
    $newusername = sanitizeString($_POST['username']);
    //controlliamo se lo username è già presente nel database
    $result = checkUsername($newusername);
    $u = $result->fetch_row();

    if($result->num_rows > 0) {
        $_SESSION['error'] = 1;
        redirect("edit-username.php");
    }
    else {
        $userid = $_SESSION['userid'];
        setUsername($userid, $newusername);
        $_SESSION['username'] = $newusername;
        setcookie("username", $newusername, strtotime("+1 year"));
        redirect("user-panel.php");
    }
}

$smarty->display('html/edit-username.html');
unset($_SESSION['error']);
