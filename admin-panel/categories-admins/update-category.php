<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(!isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
  }
  $already_exist = "";

  if(isset($_GET['cat_u_id'])){
    $update_cat_id = $_GET['cat_u_id'];
    $cat_display = $conn->prepare("SELECT * FROM categories WHERE ID = ?");
    $cat_display->execute([$update_cat_id]);
    $cat_display_row = $cat_display->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
      $cat_name = $_POST['cat_name'];
      $cat_check = $conn->query("SELECT name FROM categories WHERE name = '$cat_name'");
      $cat_check->execute();
      if($cat_check->rowCount() > 0 ){
        $already_exist = " This Category Already Exist !!";
      }else{
        $cat_query = $conn->prepare("UPDATE categories SET name = ? WHERE ID = ?");
        $cat_query->execute([$cat_name, $update_cat_id]);
        header("location: http://localhost/SOHOPRESS/admin-panel/categories-admins/show-categories.php");
        exit; 

      }

    }
}


  ?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?cat_u_id=<?php echo $update_cat_id ?>" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="cat_name" id="form2Example1" class="form-control" placeholder="<?php echo $cat_display_row->name; ?>" oninput="this.value = this.value.toUpperCase()" />
                 
                </div>

                <div class="form-outline">
                    <p class="text-danger"> <?php echo $already_exist ?></p>
                  </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
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