<?php  
    require "../includes/header.php";
    require "../config/config.php";
    require "restricted.php";
?>
<?php
    $wrong_login = "";
    if(isset($_POST['submit'])){

        $user_email = $_POST['email'];
        $user_password = $_POST['password'];

        $login = $conn->query("SELECT * FROM users WHERE email = '$user_email'");
        $login->execute();
        $fetch = $login->fetch(PDO::FETCH_ASSOC);
        if($login->rowcount() > 0){
            if(password_verify($user_password, $fetch['password'])){
                // Start Session
                $_SESSION['user_email'] = $fetch['email'];
                $_SESSION['user_name'] = $fetch['username'];
                $_SESSION['user_id'] = $fetch['ID'];

                header("location:".APPURL."");
                exit;
            }else{
                $wrong_login = "Email or Password in invalid";
            }
        }else{
            $wrong_login = "Email or Password invalid";
        }

    }


?>
       
                <!-- Main Content-->
        <div class="container px-4 px-lg-5">

               <form method="POST" action="login.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" required/>
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" required />
                    
                  </div>

                  <div class="form-outline">
                    <p class="text-danger"> <?php echo $wrong_login ?></p>
                    
                  </div>

                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                  <!-- Register buttons -->
                  <div class="text-center">
                    <p>a new member? Create an acount<a href="register.php"> Register</a></p>
                    

                   
                  </div>
                </form>

           
        </div>
    <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/script.js"></script>
    </body>
</html>
