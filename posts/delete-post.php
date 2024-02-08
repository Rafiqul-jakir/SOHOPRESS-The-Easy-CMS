<?php
    require "../config/config.php";


    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $delete_post = $conn->query("DELETE FROM `posts` WHERE ID = '$post_id'");
        $delete_post->execute();

        header("location: http://localhost/SOHOPRESS");
    }
?>