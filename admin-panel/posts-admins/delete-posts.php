<?php
  require "../layouts/header.php";
  require "../../config/config.php";

    if(isset($_GET['post_d_id'])){

        $cat_id = $_GET['post_d_id'];
        $del_post = $conn->query("DELETE FROM posts WHERE ID = '$cat_id'");
        $del_post->execute();

        header("location: http://localhost/SOHOPRESS/admin-panel/posts-admins/show-posts.php");
        exit;
    }



?>