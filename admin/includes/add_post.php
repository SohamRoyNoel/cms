<?php ob_start(); ?>
<?php
    if (isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $Post_category_id = $_POST['post_category'];
        $post_author = $_POST['author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name']; // temporary storage

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        // $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "insert into posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_status) values ({$Post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

        $lps = mysqli_query($connection, $query);

        confirm($lps);

        $post_ids = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$post_ids}'>View Post</a></p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="title">Post Status</label>
        <br>
        <select  name="post_status" id="">
            <option value="published">Select Post</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="title">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <script>
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>

</form>