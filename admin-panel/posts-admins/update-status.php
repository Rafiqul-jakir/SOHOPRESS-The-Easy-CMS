<?php
    require "../layouts/header.php";
    require "../../config/config.php";

    if(isset($_GET['post_s_id'])){

        $post_status_id = $_GET['post_s_id'];
        $post_query = $conn->query("SELECT status FROM posts WHERE ID = '$post_status_id'");
        $post_query->execute();
        $status = $post_query->fetch(PDO::FETCH_OBJ);
        if($status->status == 0){
            $update_status_query = $conn->prepare("UPDATE posts SET status = '1' WHERE ID = '$post_status_id'");
            $update_status_query->execute();
        }else{
            $update_status_query = $conn->prepare("UPDATE posts SET status = '0' WHERE ID = '$post_status_id'");
            $update_status_query->execute();
        }



        header("location: http://localhost/SOHOPRESS/admin-panel/posts-admins/show-posts.php");
        exit;

    }



?>