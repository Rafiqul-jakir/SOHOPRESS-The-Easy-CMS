<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(!isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
  }

  //query for Categories
  $cat_query = $conn->query("SELECT * FROM categories");
  $cat_query->execute();
  $all_cat = $cat_query->fetchAll(PDO::FETCH_OBJ);


?>
    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                    <tr class="text-center">
                      <th scope="col">#</th>
                      <th scope="col">name</th>
                      <th scope="col">update</th>
                      <th scope="col">delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($all_cat as $all_cat ): ?>
                  <tr class="text-center">
                    <th scope="row"><?php echo $all_cat->ID ?></th>
                    <td><?php echo $all_cat->name ?></td>
                    <td><a  href="update-category.php?cat_u_id=<?php echo$all_cat->ID?>" class="btn btn-warning text-white text-center ">Update Categories</a></td>
                    <td><a href="delete-category.php?cat_d_id = <?php echo$all_cat->ID?>" class="btn btn-danger  text-center ">Delete Categories</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
<script type="text/javascript">

</script>
</body>
</html>