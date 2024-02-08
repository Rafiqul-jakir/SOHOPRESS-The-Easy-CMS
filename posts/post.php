<?php  include "../includes/nav-bar.php"; ?>
<?php  include "../config/config.php"; ?>



<?php
    $post_id = $_GET['post_id'];
    $post_query = $conn->query("SELECT * FROM posts WHERE ID = '$post_id'");
    $post_query -> execute();
    $single_post = $post_query->fetch(PDO::FETCH_OBJ);

?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('../assets/img/post_images/<?php echo $single_post->post_image; ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $single_post->title; ?></h1>
                            <h2 class="subheading"><?php echo $single_post->sub_title; ?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $single_post->user_name; ?> </a>
                                <?php
                                    $input_date = $single_post->created_at;
                                    $output_date = date("F j, Y", strtotime($input_date));
                                ?>
                                on <?php echo $output_date; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $single_post->description; ?></p>
                        <!-- <p>
                            Placeholder text by
                            <a href="http://spaceipsum.com/">Space Ipsum</a>
                            &middot; Images by
                            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                        </p> -->
                        <?php if($single_post->user_name == $_SESSION['user_name']): ?>
                            <a href="<?php echo APPURL;?>/posts/delete-post.php?post_id=<?php echo $single_post->ID ?>" class="btn btn-danger text-center float-end">Delete</a>
                            <a href="<?php echo APPURL;?>/posts/update.php?update_id=<?php echo $single_post->ID ?>" class="btn btn-success text-center ">Update</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <?php  include "../includes/footer.php"; ?>