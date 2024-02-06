<?php 
  require "../includes/header.php";
  require "../config/config.php";  
?>



<?php

    if(isset($_POST['submit'])){
      if(empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])){
        echo "<script> alert('all field are required')</script>";
      }else{
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users(email, username, password) VALUES(:email, :username, :password)");
        $insert->execute([
          ":email" => $email,
          ":username" => $username,
          ":password" => $password,
        ]);
        header("location: login.php");
      }
    }



?>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" required />
               
              </div>

              <div class="form-outline mb-4">
                <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" required />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" required />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>


           
        </div>
    <!-- Footer-->
<?php require "../includes/footer.php" ?>