<?php ob_start(); ?>
<?php

        if (isset($_GET['p_id'])) {
            $the_post_id = $_GET['p_id'];

            $query = "select * from posts where post_id=$the_post_id";
            $select_posts_by_id = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
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
            }

            // update
            if (isset($_POST['create_post'])){ // name of the button
                $post_title = $_POST['title'];
                $Post_category_id = $_POST['post_category'];
                $post_author = $_POST['author'];
                $post_status = $_POST['post_status'];

                $post_image = $_FILES['image']['name'];
                $post_image_temp = $_FILES['image']['tmp_name']; // temporary storage

                $post_tag = $_POST['post_tags'];
                $post_contents = $_POST['post_content'];

                move_uploaded_file($post_image_temp, "../images/$post_image");

                // to solve the problem : when we update anything picture goes away
                if (empty($post_image)){ // checks if empty
                    $query = "select * from posts where post_id={$the_post_id}"; // pull
                    $select_img = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($select_img)){
                        $post_image = $row['post_image']; // pick it up
                    }
                }

                $query = "update posts set ";
                $query .= "post_title = '{$post_title}',";
                $query .= "post_category_id = '{$Post_category_id}', ";
                $query .= "post_date = now(), ";
                $query .= "post_author = '{$post_author}', ";
                $query .= "post_status = '{$post_status}', ";
                $query .= "post_tag = '{$post_tag}', ";
                $query .= "post_content = '{$post_contents}', ";
                $query .= "post_image = '{$post_image}' ";
                $query .= "where post_id = {$the_post_id}";

                $update = mysqli_query($connection, $query);

                confirm($update);

                echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a></p>";
            }
        }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="title">Post Category Id</label>
        <br>
        <select name="post_category" id="">
            <?php
                $cat_ids = $_GET['update'];
                $query = "select * from categories";
                $select_categories = mysqli_query($connection, $query);

                // confirm($select_categories);

                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="title">Post Status</label>
        <br>
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>    </div>

    <div class="form-group">
        <label for="title">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
        </div>

    <div class="form-group">
        <label for="title">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?> </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>

</form>