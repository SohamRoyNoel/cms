<?php ob_start(); ?>
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapproved</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "select * from comments";
    $select_all_comments = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];


        echo "<tr>";
        echo "<td>{$comment_id}</td>";

//        $query = "select * from categories where cat_id = {$post_category_id}";
//        $select_all_categories = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($select_all_categories)) {
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
//        }
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";


        $queries = "select * from posts where post_id = {$comment_post_id}";
        $select_in_response_to = mysqli_query($connection, $queries);

        while ($s = mysqli_fetch_assoc($select_in_response_to)){
            $response_id = $s['post_id'];
            $response_title = $s['post_title'];

            echo "<td><a href='../post.php?p_id={$response_id}'>$response_title</a></td> ";
        }




        echo "<td>{$comment_date}</td>";
        echo "<td><a href='./comments.php?approved={$comment_id}'>Approve</a> </td>";
        echo "<td><a href='./comments.php?unapproved={$comment_id}'>Unapprove</a> </td>";
        echo "<td><a href='./comments.php?delete={$comment_id}'>Delete</a> </td>";
        echo "</tr>";
    }
    ?>

    <?php
    if (isset($_GET['unapproved'])){
        $comment_id_up = $_GET['unapproved'];
        $querypt = "update comments set comment_status = 'unapproved' where comment_id={$comment_id_up}";
        $lp = mysqli_query($connection, $querypt);
        // refreshes the page, else we need click delete twice
        header("Location: ./comments.php");
    } else {
//        echo "Sorry" . mysqli_error($connection);
    }
    ?>

    <?php
    if (isset($_GET['approved'])){
        $comment_id_down = $_GET['approved'];
        $querypt = "update comments set comment_status = 'approved' where comment_id={$comment_id_down}";
        $lp = mysqli_query($connection, $querypt);
        // refreshes the page, else we need click delete twice
        header("Location: ./comments.php");
    } else {
//        echo "Sorry" . mysqli_error($connection);
    }
    ?>

    <?php
    if (isset($_GET['delete'])){
        $comment_id_del = $_GET['delete'];
        $querypt = "DELETE FROM comments WHERE comment_id = {$comment_id_del}";
        $lp = mysqli_query($connection, $querypt);
        // refreshes the page, else we need click delete twice
        header("Location: ./comments.php");
    } else {
//        echo "Sorry" . mysqli_error($connection);
    }
    ?>
    </tbody>
</table>
