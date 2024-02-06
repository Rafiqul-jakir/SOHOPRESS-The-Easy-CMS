<?php

    try {

        $host = "localhost";

        //Database
        $db_name = "sohopress";
    
        //user
        $user = "root";
    
        //password
        $pass = "";
    
        $conn = new PDO("mysql:host = $host; dbname = $db_name", $user, $pass);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>