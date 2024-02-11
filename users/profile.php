<?php
    require "../includes/header.php";
    require "../config/config.php";

    if(!isset($_SESSION['user_email'])){
        header("location: http://localhost/SOHOPRESS");
    }

    if(isset($_GET['profile_id'])){
        $profile_id = $_GET['profile_id'];
        $p_post = $conn->query("SELECT * FROM users WHERE ID = '$profile_id'");
        $p_post->execute();
        $fetch = $p_post->fetch(PDO::FETCH_OBJ);

        if($fetch->username !== $_SESSION['user_name']){
          header("location: http://localhost/SOHOPRESS");
        }
        //update query
        if(isset($_POST['submit'])){

            $username = $_POST['username'];
            $user_email = $_POST['user_email'];

            $update = $conn->query("UPDATE users SET username='$username', email='$user_email' WHERE ID = '$profile_id'");
            $update->execute();


            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_id'] = $profile_id;

            header("location: http://localhost/SOHOPRESS/users/profile.php?profile_id=".$profile_id."");
          
            
        }
    }


?>

                <!-- Main Content-->
    <div class="container px-4 px-lg-5">

            <form method="POST" action="profile.php?profile_id=<?php echo $profile_id ?>" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="text" name="username" id="form2Example1" class="form-control" placeholder="User Name" value="<?php echo $fetch->username ?>" required />
                
                </div>

                <div class="form-outline mb-4">
                    <input type="text" name="user_email" id="form2Example1" class="form-control" placeholder="User Email" value="<?php echo $fetch->email ?>" required/>
                </div>


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

            
            </form>


   
    </div>
<!-- Footer-->
<?php require "../includes/footer.php"  ?>