<?php

if (isset($_GET['p_id'])) {
    $the_user_id = $_GET['p_id'];

    $query = "select * from users where user_id=$the_user_id";
    $select_user_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
        // $user_randSalt = $row['randSalt'];
    }



    // update
    if (isset($_POST['edit_user'])){ // name of the button

        $user_nm = $_POST['user_nm'];
        $user_fn = $_POST['user_fn'];
        $user_ln = $_POST['user_ln'];
        $user_em = $_POST['user_em'];
        $user_rl = $_POST['user_rl'];
        $user_ps = $_POST['user_ps'];

        if (!empty($user_password)){
            $query_ps = "select user_password from users where user_id = $the_user_id";
            $get_user = mysqli_query($connection, $query_ps);

            $row = mysqli_fetch_array($get_user);

            $db_user_password = $row['user_password'];

            if (!password_verify($user_ps, $db_user_password)) {
                $db_user_password = password_hash($user_ps, PASSWORD_BCRYPT, array('cost' => 12));

                $query = "update users set  ";
                $query .= "user_password = '{$db_user_password}',";
                $query .= "user_name = '{$user_nm}',";
                $query .= "user_firstname = '{$user_fn}', ";
                $query .= "user_lastname = '{$user_ln}', ";
                $query .= "user_email = '{$user_em}', ";
                $query .= "user_role = '{$user_rl}' ";
                $query .= "where user_id = {$the_user_id}";

                $update = mysqli_query($connection, $query);

                confirm($update);
            }


        }


    }
}
?>
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
        <label for="title">Password</label>
        <input type="password" value="" autocomplete="off" class="form-control" name="user_ps">
    </div>

    <div class="form-group">
        <label for="title">User email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_em">
    </div>

    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="title">User Role</label>
        <br>
        <select name="user_rl" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option> <!-- for default -->
            <?php
                if ($user_role == 'admin')
                    echo "<option value=\"subscriber\">Subscriber</option>";
                else
                    echo "<option value=\"admin\">Admin</option>";
            ?>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
</form>

