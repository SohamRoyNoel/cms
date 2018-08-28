<?php ob_start(); ?>
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>user_Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "select * from users";
    $select_all_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_comments)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];


        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_image}</td>";
        echo "<td>{$user_role}</td>";

        echo "<td><a href='./users.php?change_to_admin={$user_id}'>Admin</a> </td>";
        echo "<td><a href='./users.php?Change_to_sub={$user_id}'>Subscriber</a> </td>";
        echo "<td><a href='./users.php?delete={$user_id}'>Delete</a> </td>";
        echo "<td><a href='./users.php?source=edit_users&p_id={$user_id}'>Edit</a> </td>";

        echo "</tr>";
    }
    ?>


    <?php
    if (isset($_GET['change_to_admin'])){
        $make_admin = $_GET['change_to_admin'];
        $querypt = "update users set user_role = 'Admin' where user_id={$make_admin}";
        $lp = mysqli_query($connection, $querypt);
        // refreshes the page, else we need click delete twice
        header("Location: ./users.php");
    }
    ?>

    <?php
    if (isset($_GET['Change_to_sub'])){
        $make_sub = $_GET['Change_to_sub'];
        $querypt = "update users set user_role = 'Subscriber' where user_id={$make_sub}";
        $lp = mysqli_query($connection, $querypt);
        header("Location: ./users.php");
    }
    ?>

    <?php
    if (isset($_GET['delete'])){
        $user_id_del = $_GET['delete'];
        $querypt = "DELETE FROM users WHERE user_id = {$user_id_del}";
        $lp = mysqli_query($connection, $querypt);
        header("Location: ./users.php");
    }
    ?>
    </tbody>
</table>
