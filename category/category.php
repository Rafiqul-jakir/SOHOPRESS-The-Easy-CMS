<?php  
    include "../includes/nav-bar.php";
    include "../config/config.php";

    if(isset($_GET['cat_name'])){
        $cat_name = $_GET['cat_name'];

        $cat_post = $conn->query("SELECT * FROM posts WHERE categories = '$cat_name' ORDER BY created_at DESC");
        $cat_post->execute();
        $post = $cat_post->fetchAll(PDO::FETCH_OBJ);
    }else{
        header("location:".APPURL."/404.php");
        exit;
    }
    
?>

        <header class="masthead" style="background-image: url('../assets/img/post_images/')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1 class="text-center">CATEGORY: <?php echo $cat_name; ?></h1>
                            <h2 class="subheading text-center">Number of Post: <?php echo $cat_post->rowcount(); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php foreach($post as $post): ?>
                    <div class="post-preview">
                        <a href="../posts/post.php?post_id=<?php echo $post->ID ?>">
                            <h2 class="post-title"><?php echo $post->title ?></h2>
                            <h3 class="post-subtitle"><?php echo $post->sub_title ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $post->user_name ?></a>
                            <?php
                                $input_date = $post->created_at;
                                $output_date = date("F j, Y", strtotime($input_date));
                            ?>
                            on <?php echo $output_date; ?>
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Pager-->
                    <?php endforeach; ?>
                </div>
            </div>

<?php include "../includes/footer.php" ?>