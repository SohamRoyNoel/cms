<?php ob_start(); ?>
<?php include "includes/header.php" ?>
<?php
if (isset($_SESSION['em'])){
    $userem = $_SESSION['em'];
    $user_id = $_SESSION['id'];

    $query = "select * from users where user_email = '{$userem}'";

    $find = mysqli_query($connection, $query);

    confirm($find);

    while ($row = mysqli_fetch_assoc($find)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        // $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
    }
}
?>

<?php
        if (isset($_POST['edit_user'])){

            $user_nm = $_POST['user_nm'];
            $user_fn = $_POST['user_fn'];
            $user_ln = $_POST['user_ln'];
            $user_em = $_POST['user_em'];
            $user_rl = $_POST['user_rl'];


            $query = "update users set  ";
            $query .= "user_name = '{$user_nm}',";
            $query .= "user_firstname = '{$user_fn}', ";
            $query .= "user_lastname = '{$user_ln}', ";
            $query .= "user_email = '{$user_em}', ";
            $query .= "user_role = '{$user_rl}' ";
            $query .= "where user_id = {$user_id}";

            $update = mysqli_query($connection, $query);

            confirm($update);
        }
?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small>Author</small>
                    </h1>
                </div>


                <form action="" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="title">UserName</label>
                        <input type="text" value="<?php  echo $user_name; ?>" class="form-control" name="user_nm">
                    </div>

                    <div class="form-group">
                        <label for="title">First name</label>
                        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_fn">
                    </div>

                    <div class="form-group">
                        <label for="title">Last name</label>
                        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_ln">
                    </div>

                    <div class="form-group">
                        <label for="title">User email</label>
                        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_em">
                    </div>

                    <div class="form-group">
                        <label for="title">Password</label>
                        <input type="password" value="<?php ?>" class="form-control" name="user_em">
                    </div>

                    <div class="form-group">
                        <label for="title">Post Image</label>
                        <input type="file" name="image">
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Role</label>-->
<!--                        <br>-->
<!--                        <select class="btn btn-secondary dropdown-toggle" name="user_rl" id="">-->
<!--                            <option value="subscriber">--><?php //echo $user_role; ?><!--</option> <!-- for default -->
<!--                            <option value="admin">Admin</option>-->
<!--                            <option value="subscriber">Subscriber</option>-->
<!--                        </select>-->
<!--                    </div>-->

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                    </div>
                </form>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>