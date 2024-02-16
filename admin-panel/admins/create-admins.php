<?php
require "../layouts/header.php";
require "../../config/config.php";

if (!isset($_SESSION['admin_email'])) {
    header("location: " . ADMINURL . "");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['admin_email']) || empty($_POST['admin_name']) || empty($_POST['admin_password'])) {
        echo "<script> alert('all field are required')</script>";
    } else {
        $admin_email = $_POST['admin_email'];
        $admin_name = $_POST['admin_name'];
        $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO admins(admin_email, admin_name, admin_password) VALUES(:admin_email, :admin_name, :admin_password)");
        $insert->execute([
            ":admin_email" => $admin_email,
            ":admin_name" => $admin_name,
            ":admin_password" => $admin_password,
        ]);
        header("location: admins.php");
    }
}

?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4 mt-4">
              <input type="email" name="admin_email" id="form2Example1" class="form-control" placeholder="email" required />

            </div>

            <div class="form-outline mb-4">
              <input type="text" name="admin_name" id="form2Example1" class="form-control" placeholder="username" required />
            </div>
            <div class="form-outline mb-4">
              <input type="password" name="admin_password" id="form2Example1" class="form-control" placeholder="password" required />
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
