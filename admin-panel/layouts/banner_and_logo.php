<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(!isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
    exit;
  }

  if(isset($_POST['submit'])){
    $logo_title = $_POST['logo_title'];
    $company_name = $_POST['company_name'];
    $sub_title = $_POST['sub_title'];
    $image = $_FILES['banner_img']['name'];  
    $image_tmp = $_FILES['banner_img']['tmp_name']; 

    $dir = "../../assets/img/post_images/".basename($image);

    $insert_post = $conn->prepare("INSERT INTO logo_and_banner(logo_title, company_name, sub_title, banner) VALUES(:logo_title, :company_name, :sub_title, :banner)");
    $insert_post->execute([
        ":logo_title" => $logo_title,
        ":company_name" => $company_name ,
        ":sub_title" => $sub_title ,
        ":banner" => $image ,
    ]);

    if(move_uploaded_file($image_tmp, $dir)){
        header("location: http://localhost/SOHOPRESS/admin-panel/layouts/banner_and_logo.php");
        exit;
    }else{
        header("location: http://localhost/SOHOPRESS/404.php");
        exit;
    }
}



?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Banner and Logo</h5>
              <form method="POST" action="banner_and_logo.php" enctype="multipart/form-data" class="mt-2">
              <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" name="logo_title" id="form2Example1" class="form-control" placeholder="Logo title" required />
                
                </div>

                <div class="form-outline mb-4">
                    <input type="text" name="company_name" id="form2Example1" class="form-control" placeholder="Comany Name" required/>
                </div>

                <div class="form-outline mb-4">
                    <textarea type="text" name="sub_title" id="form2Example1" class="form-control" placeholder="Sub title" rows="8" required></textarea>
                </div>

              
                <div class="form-outline mb-4">
                    <input type="file" name="banner_img" id="form2Example1" class="form-control" placeholder="image" required/>
                </div>




              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
            </form>

            </div>
          </div>
        </div>
      </div>
  </div>
<script type="text/javascript">

</script>
</body>
</html>