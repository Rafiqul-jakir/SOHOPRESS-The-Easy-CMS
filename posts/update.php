<?php
    require "../includes/header.php";
    require "../config/config.php";

    if(!isset($_SESSION['user_email'])){
        header("location: http://localhost/SOHOPRESS");
        exit;
    }
    $cat_query = $conn->query("SELECT * FROM categories ORDER BY created_at DESC");
    $cat_query->execute();
    $category = $cat_query->fetchAll(PDO::FETCH_OBJ);

    if(isset($_GET['update_id'])){
        $update_id = $_GET['update_id'];
        $p_post = $conn->query("SELECT * FROM posts WHERE ID = '$update_id'");
        $p_post->execute();
        $fetch = $p_post->fetch(PDO::FETCH_OBJ);

        if($fetch->user_name !== $_SESSION['user_name']){
          header("location: http://localhost/SOHOPRESS");
          exit;
        }
        //update query
        if(isset($_POST['submit'])){
          
            unlink("../assets/img/post_images/".$fetch->post_image."");
            $title = $_POST['title'];
            $sub_title = $_POST['sub_title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $image = $_FILES['post_img']['name'];  
            $image_tmp = $_FILES['post_img']['tmp_name']; 
    
            $user_name = $_SESSION['user_name'];
    
            $dir = "../assets/img/post_images/".basename($image);

            $update = $conn->query("UPDATE posts SET title='$title',sub_title='$sub_title',description='$description', post_image = '$image', categories = '$category' WHERE ID = '$update_id'");
            $update->execute();

            if(move_uploaded_file($image_tmp, $dir)){
              header("location: http://localhost/SOHOPRESS/posts/post.php?post_id=".$update_id."");
              exit;
            }
            
        }
    }else{
      header("location:".APPURL."/404.php");
      exit;
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

            <?php echo "<img src='../assets/img/post_images/{$fetch->post_image}' width='100px' height='100px'/>"; ?>

             <div class="form-outline mb-4">
                <input type="file" name="post_img" id="form2Example1" class="form-control" placeholder="image" />
            </div>

            <div class="form-outline mb-4">
                <label for="category" class="form-label">Update Categories</label>
                <select name = "category" class="form-select" id="category" required>
                    <?php foreach($category as $category ): ?>
                        <option value="<?php echo $category->name ?>"><?php echo $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>


           
        </div>
    <!-- Footer-->
    <?php require "../includes/footer.php"  ?>