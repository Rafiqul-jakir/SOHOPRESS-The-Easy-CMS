<?php
  require "../layouts/header.php";
  require "../../config/config.php";

    if(isset($_GET['post_d_id'])){

        $post_d_id = $_GET['post_d_id'];
        $del_post = $conn->query("DELETE FROM posts WHERE ID = '$post_d_id'");
        $del_post->execute();

        $del_post_cmt = $conn->query("DELETE FROM comments WHERE post_id = '$post_d_id'");
        $del_post_cmt->execute();

        header("location: http://localhost/SOHOPRESS/admin-panel/posts-admins/show-posts.php");
        exit;
    }



?>