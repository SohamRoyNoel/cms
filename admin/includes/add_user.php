<?php ob_start(); ?>
<?php
    if (isset($_POST['create_user'])){
        $user_nm = $_POST['user_nm'];
        $user_ps = $_POST['user_ps'];
        $user_fn = $_POST['user_fn'];
        $user_ln = $_POST['user_ln'];

//        $post_image = $_FILES['image']['name'];
//        $post_image_temp = $_FILES['image']['tmp_name']; // temporary storage

        $user_em = $_POST['user_em'];
        $user_rl = $_POST['user_rl'];

//        move_uploaded_file($post_image_temp, "../images/$post_image");

        // $ps = password_hash($ps, PASSWORD_BCRYPT, array('cost'=>12));
        $user_ps  = password_hash($user_ps, PASSWORD_BCRYPT, array('cost'=>12));

        $query = "insert into users (user_name, user_password, user_firstname, user_lastname, user_email, user_role) values ('{$user_nm}', '{$user_ps}', '{$user_fn}', '{$user_ln}', '{$user_em}', '{$user_rl}') ";

        $lps = mysqli_query($connection, $query);

        confirm($lps);
    }
?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">UserName</label>
        <input type="text" class="form-control" name="user_nm">
    </div>

    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="user_ps">
    </div>

    <div class="form-group">
        <label for="title">First name</label>
        <input type="text" class="form-control" name="user_fn">
    </div>

    <div class="form-group">
        <label for="title">Last name</label>
        <input type="text" class="form-control" name="user_ln">
    </div>

    <div class="form-group">
        <label for="title">User email</label>
        <input type="text" class="form-control" name="user_em">
    </div>

    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="title">User Role</label>
        <br>
        <select name="user_rl" id="">
            <option value="subscriber">Select Role</option> <!-- for default -->
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>