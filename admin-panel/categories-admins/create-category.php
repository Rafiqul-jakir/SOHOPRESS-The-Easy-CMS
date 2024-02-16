<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(!isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
  }
  if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];
    $cat_query = $conn->prepare("INSERT INTO categories(name) VALUES(:name)");
    $cat_query->execute([
      ":name" => $cat_name,
    ]);

    header("location: http://localhost/SOHOPRESS/admin-panel//categories-admins/show-categories.php");

  }


  ?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="cat_name" id="form2Example1" class="form-control" placeholder="name"  oninput="this.value = this.value.toUpperCase()"/>
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
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