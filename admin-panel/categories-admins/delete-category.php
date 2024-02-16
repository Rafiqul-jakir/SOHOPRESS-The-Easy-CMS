<?php
  require "../layouts/header.php";
  require "../../config/config.php";

    if(isset($_GET['cat_d_id'])){

        $cat_id = $_GET['cat_d_id'];
        $del_query = $conn->query("DELETE FROM categories WHERE ID = '$cat_id'");
        $del_query->execute();

        header("location: http://localhost/SOHOPRESS/admin-panel/categories-admins/show-categories.php");
        exit;
    }



?>