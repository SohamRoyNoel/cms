<?php include "db.php" ?>
<?php session_start(); ?>
<?php

        if (isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $uname = mysqli_real_escape_string($connection, $email);
            $pass = mysqli_real_escape_string($connection, $password);

            $query  = "select * from users where user_email = '{$uname}'";
            $select_user = mysqli_query($connection, $query);

            if (!$select_user){
                die("Query failed" . mysqli_error());
            }

            while ($row = mysqli_fetch_assoc($select_user)){
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_role = $row['user_role'];
                $user_email = $row['user_email'];
            }

            // if you use BLOWFISH crypting
            // $password = crypt($password,$user_password);
            // === stands for identical
            //if ($email === $user_email && $password === $user_password)
            if (password_verify($password, $user_password)){
                $_SESSION['un'] = $user_name;
                $_SESSION['fn'] = $user_firstname;
                $_SESSION['ln'] = $user_lastname;
                $_SESSION['rl'] = $user_role;
                $_SESSION['em'] = $email;
                $_SESSION['id'] = $user_id;


                header("Location:../admin");
            } else {
                header("Location:../index.php");
            }
        }

?>
