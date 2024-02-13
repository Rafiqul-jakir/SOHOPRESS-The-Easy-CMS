<?php
  require "../layouts/header.php";
  require "../../config/config.php";


  if(isset($_SESSION['admin_email'])){
    header("location: ".ADMINURL."");
  }

?>
<?php

  $wrong_login = "";
  if(isset($_POST['submit'])){

      $admin_email = $_POST['email'];
      $admin_password = $_POST['password'];

      $login = $conn->query("SELECT * FROM admins WHERE admin_email = '$admin_email'");
      $login->execute();
      $fetch = $login->fetch(PDO::FETCH_ASSOC);
      if($login->rowcount() > 0){
          if(password_verify($admin_password, $fetch['admin_password'])){
              // Start Session
              $_SESSION['admin_email'] = $fetch['admin_email'];
              $_SESSION['admin_name'] = $fetch['admin_name'];
              $_SESSION['admin_id'] = $fetch['ID'];


              header("location:".ADMINURL."");
          }else{

            $wrong_login = "Email or Password in invalid";
          }
      }else{

          $wrong_login = "Email or Password invalid";
          
      }

  }

?>
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mt-5">Login</h5>
                <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input
                      type="email"
                      name="email"
                      id="form2Example1"
                      class="form-control"
                      placeholder="Email"
                    />
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input
                      type="password"
                      name="password"
                      id="form2Example2"
                      placeholder="Password"
                      class="form-control"
                    />
                  </div>
                  <div class="form-outline">
                    <p class="text-danger"> <?php echo $wrong_login ?></p>
                  </div>
                  <!-- Submit button -->
                  <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary mb-4 text-center"
                  >
                    Login
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
