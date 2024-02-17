<?php
    require "../layouts/header.php";
    require "../../config/config.php";

    if(isset($_GET['comment_s_id'])){

        $comment_status_id = $_GET['comment_s_id'];
        $comment_query = $conn->query("SELECT status FROM comments WHERE ID = '$comment_status_id'");
        $comment_query->execute();
        $status = $comment_query->fetch(PDO::FETCH_OBJ);
        if($status->status == 0){
            $update_status_query = $conn->prepare("UPDATE comments SET status = '1' WHERE ID = '$comment_status_id'");
            $update_status_query->execute();
        }else{
            $update_status_query = $conn->prepare("UPDATE comments SET status = '0' WHERE ID = '$comment_status_id'");
            $update_status_query->execute();
        }



        header("location: http://localhost/SOHOPRESS/admin-panel/comments/show_comment.php");
        exit;

    }



?>