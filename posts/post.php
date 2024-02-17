<?php  include "../includes/nav-bar.php"; ?>
<?php  include "../config/config.php"; ?>



<?php
    $post_id = $_GET['post_id'];

    $post_query = $conn->query("SELECT * FROM posts WHERE ID = '$post_id'");
    $post_query -> execute();
    $single_post = $post_query->fetch(PDO::FETCH_OBJ);
    
    if($post_query->rowCount() == 0){
        header("location: ".APPURL."/404.php");
        exit;
    }

    $cmt_query = $conn->query("SELECT * FROM comments WHERE post_id = '$post_id' AND status = '1' ORDER BY created_at DESC");
    $cmt_query->execute();
    $all_cmt = $cmt_query->fetchAll(PDO::FETCH_OBJ);

    $cmt_check_query = $conn->query("SELECT * FROM comments WHERE post_id = '$post_id' AND status = '0' AND user_name = '$_SESSION[user_name]'");
    $cmt_check_query->execute();

    if(isset($_POST['submit']) && isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $insert_cmt = $conn->prepare("INSERT INTO comments(comment, post_id, user_name, status) VALUES(:comment, :post_id, :user_name, :status)");
        $insert_cmt->execute([
            ":comment" => $_POST['comment'],
            ":post_id" => $post_id,
            ":user_name" =>$_SESSION['user_name'],
            ":status" => 0,
        ]);
        header("location: http://localhost/SOHOPRESS/posts/post.php?post_id=".$post_id ."");
    }

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
                        <?php if(isset($_SESSION['user_name'])): ?>
                            <?php if($single_post->user_name == $_SESSION['user_name']): ?>
                                <a href="<?php echo APPURL;?>/posts/delete-post.php?post_id=<?php echo $single_post->ID ?>" class="btn btn-danger text-center float-end">Delete</a>
                                <a href="<?php echo APPURL;?>/posts/update.php?update_id=<?php echo $single_post->ID ?>" class="btn btn-success text-center ">Update</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>

        <!-- comment  -->
        <section>
          <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>


                <div class="card">
                    <div class="card-body">
                        <?php if($cmt_query->rowCount() > 0 ): ?>
                            <?php foreach($all_cmt as $all_cmt): ?>
                                <div class="d-flex flex-start align-items-center">
                                    <?php
                                        $input_date = $all_cmt->created_at;
                                        $output_date = date("F j, Y", strtotime($input_date));
                                    ?>
                                    <div>
                                        <h6 class="fw-bold text-primary">
                                            <?php echo $all_cmt->user_name; ?>
                                            <small class="p-3 text-black">(<?php echo $output_date ?>)</small>
                                        </h6>
                                    </div>
                                </div>
                                <div>
                                    <p class="mt-3 mb-4 pb-2 pl-5">
                                        <?php echo $all_cmt->comment; ?>
                                    </p>
                                    <hr class="my-4" />
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center">
                                <p>No comment for this Post . <br> Be the first Comment !!</p>
                            </div>
                        <?php endif; ?>

                        <?php if($cmt_check_query->rowCount() > 0): ?>
                            <div class="text-center alert alert-success"> Your Comment is forward to the admin for Approval !!</div>
                        <?php endif; ?>
                    </div>
                    
                  <?php if(isset($_SESSION['user_name'])): ?>
                    <form method="POST" action="post.php?post_id=<?php echo $single_post->ID ?>">

                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                                <div class="d-flex flex-start w-100">
                                
                                    <div class="form-outline w-100">
                                        <textarea class="form-control" id="" placeholder="write message" rows="4"
                                        name="comment" required></textarea>
                                    
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Footer-->
        <?php  include "../includes/footer.php"; ?>