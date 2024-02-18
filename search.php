<?php
    ob_start(); 
    require "includes/header.php";
    require "config/config.php";
?>
<?php
    
    if(!isset($_SERVER['HTTP_REFERER'])){
		header("location:".APPURL."");
		exit;
        
	}

    $cat_query = $conn->query("SELECT * FROM categories ORDER BY created_at DESC");
    $cat_query->execute();
    $category = $cat_query->fetchAll(PDO::FETCH_OBJ);




    if(isset($_POST['search'])){


            $search = $_POST['search'];
            $search_query = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' AND status = '1' ORDER BY created_at DESC");
            $search_query->execute();
    
            $posts= $search_query->fetchAll(PDO::FETCH_OBJ);


    }

    ob_end_flush();
?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                <!-- Post preview-->
                <?php if($search_query->rowCount() == 0 ): ?>
                    <div class="text-center alert alert-danger">
                        No related post found !!
                    </div>
                <?php else: ?>
                    <div class="">Number of Post: <?php echo $search_query->rowCount(); ?> </div>
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
                <?php endif; ?>

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