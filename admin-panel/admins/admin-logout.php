<?php
    require "../layouts/header.php";

    session_start();
    session_unset();
    session_destroy();
    
    header("location: http://localhost/SOHOPRESS/admin-panel/admins/login-admins.php");
    exit;
?>