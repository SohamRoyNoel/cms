<?php
include "includes/header.php";
?>
<!-- Navigation -->
<?php
include "includes/navigation.php";
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                // include "includes/db.php";
                $query = "select * from posts where post_id = $the_post_id";
                $select_all_posts_query = mysqli_query($connection, $query);

                $qu = "update posts set view_counter=view_counter+1 where post_id=$the_post_id";
                $xpx = mysqli_query($connection, $qu);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>


                    <hr>
                    <?php
                }
            } else{
                header("Location: index.php");
            }
            ?>

            <?php
            if (isset($_POST['create_comment'])){
                $the_post_id = $_GET['p_id'];

                $author = $_POST['comment_author'];
                $email = $_POST['comment_email'];
                $comment = $_POST['comment_content'];

                if (!empty($author) && !empty($email) && !empty($comment)) {
                    $query = "insert into comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) values ({$the_post_id}, '{$author}', '{$email}', '{$comment}', 'Approved', now())";

                    $go = mysqli_query($connection, $query);

                    // confirm($go);

                    // incrementing post counts -> admin/includes/add_post.php
                    $qna = "update posts set post_comment_count = post_comment_count + 1 where post_id = $the_post_id";
                    $exe = mysqli_query($connection, $qna);

                } else{
                    echo "<script>alert('Fields can not be empty')</script>";
                }
            }
            ?>

            <!-- Comment form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Author's name</label>
                        <input type="text" class="form-control" name="comment_author" placeholder="name">
                    </div>

                    <div class="form-group">
                        <label for="title">Author's email</label>
                        <input type="email" class="form-control" name="comment_email" placeholder="email">
                    </div>


                    <div class="form-group">
                        <label for="title">Comment</label>
                        <textarea class="form-control" id="body" rows="3" name="comment_content" placeholder="comment"></textarea>
                    </div>
                    <script>
                        ClassicEditor
                            .create( document.querySelector( '#body' ) )
                            .catch( error => {
                                console.error( error );
                            } );
                    </script>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>

</div>
<!-- /.row -->

<hr>

<?php
include "includes/footer.php";
?>

