<?php
  require "../layouts/header.php";
  require "../../config/config.php";

    if(isset($_GET['comment_d_id'])){

        $cmt_id = $_GET['comment_d_id'];
        $del_query = $conn->query("DELETE FROM comments WHERE ID = '$cmt_id'");
        $del_query->execute();

        header("location: http://localhost/SOHOPRESS/admin-panel/comments/show_comment.php");
        exit;
    }



?>