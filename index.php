<?php
    require "includes/header.php";
    require "config/config.php";

?>
<?php

    $post_query = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    $post_query->execute();
    $posts = $post_query->fetchAll(PDO::FETCH_OBJ);

    $cat_query = $conn->query("SELECT * FROM categories ORDER BY created_at DESC");
    $cat_query->execute();
    $category = $cat_query->fetchAll(PDO::FETCH_OBJ);


?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php foreach($posts as $posts): ?>
                    <div class="post-preview">
                        <a href="posts/post.php?post_id=<?php echo $posts->ID ?>">
                            <h2 class="post-title"><?php echo $posts->title ?></h2>
                            <h3 class="post-subtitle"><?php echo $posts->sub_title ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!"><?php echo $posts->user_name ?></a>
                            <?php
                                $input_date = $posts->created_at;
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
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="text-center p-5">
                    <h2>Categories</h2>
                </div>
                <?php foreach($category as $category): ?>
                    <div class="col-md-6 text-center ">
                        <a href="<?php echo APPURL ?>/category/category.php?cat_name=<?php echo $category->name ?>">
                            <div class="alert alert-dark bg-dark text-white" role="alert">
                                <?php echo $category->name ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
        <!-- Footer-->
<?php require "includes/footer.php"  ?>
