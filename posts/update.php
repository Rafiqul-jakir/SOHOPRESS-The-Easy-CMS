<?php
    require "../includes/header.php";
    require "../config/config.php";

    if(!isset($_SESSION['user_email'])){
        header("location: http://localhost/SOHOPRESS");
    }
    if(isset($_GET['update_id'])){
        $update_id = $_GET['update_id'];
        $p_post = $conn->query("SELECT * FROM posts WHERE ID = '$update_id'");
        $p_post->execute();
        $fetch = $p_post->fetch(PDO::FETCH_OBJ);

        //update query
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $sub_title = $_POST['sub_title'];
            $description = $_POST['description'];

            $update = $conn->query("UPDATE posts SET title='$title',sub_title='$sub_title',description='$description' WHERE ID = '$update_id'");
            $update->execute();

            header("location: http://localhost/SOHOPRESS/posts/post.php?post_id=".$update_id."");
        }
    }


?>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

        <form method="POST" action="update.php?update_id=<?php echo $update_id ?>" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="<?php echo $fetch->title ?>" required />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="sub_title" id="form2Example1" class="form-control" placeholder="<?php echo $fetch->sub_title ?>" required/>
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="description" id="form2Example1" class="form-control" placeholder="<?php echo $fetch->description ?>" rows="8" required></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="post_img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>


           
        </div>
    <!-- Footer-->
    <?php require "../includes/footer.php"  ?>