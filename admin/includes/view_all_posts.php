<?php
// check the names of the elements
if (isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $row){

       $bos = $_POST['bulk_options'];

        switch ($bos){
            case 'published':
                $up = "update posts set post_status = 'published' where post_id = $row";
                $gr = mysqli_query($connection, $up);
                break;
            case 'draft':
                $down = "update posts set post_status = 'draft' where post_id = $row";
                $grs = mysqli_query($connection, $down);
                break;
            case 'delete':
                $del = "delete from posts where post_id = $row";
                $grs = mysqli_query($connection, $del);
                break;
            case 'clone':
                $query = "select * from posts where post_id=$row";
                $select_all_posts = mysqli_query($connection, $query);

                while ($rown = mysqli_fetch_assoc($select_all_posts)) {
                    $post_id = $rown['post_id'];
                    $post_category_id = $rown['post_category_id'];
                    $post_title = $rown['post_title'];
                    $post_author = $rown['post_author'];
                    $post_date = $rown['post_date'];
                    $post_image = $rown['post_image'];
                    $post_content = $rown['post_content'];
                    $post_tags = $rown['post_tag'];
                    $post_comment_count = $rown['post_comment_count'];
                    $post_status = $rown['post_status'];
                }

                $queryss = "insert into posts (post_title, post_author, post_date, post_image, post_content, post_tag, post_status) values ('{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                $gota = mysqli_query($connection, $queryss);
                break;
        }
    }
}

?>
<?php ob_start(); ?>


<form action="" method="post">
<table class="table table-hover table-responsive">

    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="" >
            <option value="">Select options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>

        </select>
    </div>

    <div class="col-xs-5">

        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
        <br>

    </div>

    <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Status</th>
        <th>Comments</th>
<!--        <th>View</th>-->
    </tr>
    </thead>
    <tbody>

    <?php
    $query = "select * from posts";
    $select_all_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tag'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_view = $row['view_counter'];

        echo "<tr>";
        ?>

        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

        <?php
        echo "<td>{$post_id}</td>";

        $query = "select * from categories where cat_id = {$post_category_id}";
        $select_all_categories = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
        }
        echo "<td>{$cat_title}</td>";



        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a> </td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><img width='100' height='50' src='../images/{$post_image}'></td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_view}</td>";
        // echo "<td><a onclick=\" javascript: return confirm('Are you want to reset views'); \" href='./posts.php?rest={$post_id}'>Reset</a> </td>";
        echo "<td><a onclick=\" javascript: return confirm('Are you want to delete this'); \" href='./posts.php?delete={$post_id}'>Delete</a> </td>";
        echo "<td><a href='./posts.php?source=edit_post&p_id={$post_id}'>Update</a> </td>";
        echo "</tr>";
    }
    ?>

    <?php
    if (isset($_GET['delete'])){
        $post_id_del = $_GET['delete'];
        $queryp = "DELETE FROM posts WHERE post_id = {$post_id_del}";
        $lp = mysqli_query($connection, $queryp);
        // refreshes the page, else we need click delete twice
        header("Location: ./posts.php");
    } else {
//        echo "Sorry" . mysqli_error($connection);
    }
    ?>

<!--    --><?php
//    if (isset($_GET['rest'])){
//        $post_id_ret = $_GET['rest'];
//        $p = 0;
//        $queryp = "update posts set view_counter=$p where post_id=$post_id_ret";
//        $lp = mysqli_query($connection, $queryp);
//        header("Location: ./posts.php");
//    }
//    ?>
    </tbody>
</table>
</form>