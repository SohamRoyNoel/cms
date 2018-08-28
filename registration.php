<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>
<?php
        if (isset($_POST['submit'])){
            $un = $_POST['username'];
            $em = $_POST['email'];
            $ps = $_POST['password'];


            if (!empty($un) && !empty($em) && !empty($ps)) {
                $un = mysqli_real_escape_string($connection, $un);
                $em = mysqli_real_escape_string($connection, $em);
                $ps = mysqli_real_escape_string($connection, $ps);

                // instade of RANDSALT, encryption default
                $ps = password_hash($ps, PASSWORD_BCRYPT, array('cost'=>12));

//                $query = "select randSalt from users";
//                $select_rand = mysqli_query($connection, $query);
//                if (!$select_rand) {
//                    die("Failed " . mysqli_error($connection));
//                }
//                $row = mysqli_fetch_array($select_rand);
//                $salt = $row['randSalt'];
//
//                $ps = crypt($ps, $salt);

                $query = "insert into users (user_name, user_email, user_password) values ('{$un}','$em', '{$ps}')";
                $cons = mysqli_query($connection, $query);

                $message = "your form has been submitted";
            } else{
                $message = "Fields cannot be empty";
            }
        } else{
            $message="";
        }
?>

    <!-- Navigation -->
    

    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
