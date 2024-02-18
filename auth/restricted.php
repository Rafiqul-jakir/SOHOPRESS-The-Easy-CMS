<?php
    if(isset($_SESSION['user_email'])){
        header("location: http://localhost/SOHOPRESS");
        exit;
    }

?>