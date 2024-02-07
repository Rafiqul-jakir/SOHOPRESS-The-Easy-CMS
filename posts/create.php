<?php
    require "../includes/header.php";
    require "../config/config.php";

    if(!isset($_SESSION['user_email'])){
        header("location: http://localhost/SOHOPRESS");
    }

?>
<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $sub_title = $_POST['sub_title'];
        $description = $_POST['description'];
        $image = $_FILES['post_img']['name'];  
        $image_tmp = $_FILES['post_img']['tmp_name']; 

        $user_name = $_SESSION['user_name'];

        $dir = "../assets/img/post_images/".basename($image);

        $insert_post = $conn->prepare("INSERT INTO posts(title, sub_title, description, post_image, user_name) VALUES(:title, :sub_title, :description, :post_image, :user_name)");
        $insert_post->execute([
            ":title" => $title,
            ":sub_title" => $sub_title ,
            ":description" => $description ,
            ":post_image" => $image ,
            ":user_name" => $user_name,
        ]);

        if(move_uploaded_file($image_tmp, $dir)){
            header("location: ".APPURL."");
        }
    }


?>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" required />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="sub_title" id="form2Example1" class="form-control" placeholder="subtitle" required/>
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="description" id="form2Example1" class="form-control" placeholder="Description" rows="8" required></textarea>
            </div>

              
             <div class="form-outline mb-4">
                <input type="file" name="post_img" id="form2Example1" class="form-control" placeholder="image" required/>
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>
        </div>

<?php require "../includes/footer.php"  ?>