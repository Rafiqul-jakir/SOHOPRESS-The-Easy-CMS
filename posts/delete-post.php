<?php
    require "../includes/nav-bar.php";
    require "../config/config.php";


    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];

        $select_img = $conn->query("SELECT * FROM posts WHERE ID = '$post_id'");
        $select_img->execute();
        $img_name = $select_img->fetch(PDO::FETCH_OBJ);

        if($img_name->user_name !== $_SESSION['user_name']){
            header("location: http://localhost/SOHOPRESS");
          }

        unlink("../assets/img/post_images/".$img_name->post_image."");

        $delete_post = $conn->query("DELETE FROM `posts` WHERE ID = '$post_id'");
        $delete_post->execute();

        header("location: http://localhost/SOHOPRESS");
    }
?>