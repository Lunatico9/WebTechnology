<?php

require_once 'function.php';

sessionManager();

if (!isset($_SESSION['userid'])) {
    redirect("login.php");
}
else {
    redirect("user-panel.php");
}