<?php include "includes/header.php" ?>

    <div id="wrapper">

<?php
        // to find the active users

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 600;
            $time_out = $time - $time_out_in_seconds;

            $query = "select * from users_online where session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == null) {
                mysqli_query($connection, "insert into users_online(session, time) values('$session', 'time')");
            } else {
                mysqli_query($connection, "update users_online set time = '$time' where session ='$session'");
            }

            $users_online_query = mysqli_query($connection, "select * from users_online where time > '$time_out'");
            $count_user = mysqli_num_rows($users_online_query);
            $_SESSION['cnts'] = $count_user;

?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"?>

    <div id="page-wrapper">
        <?php if ($connection) echo ""; ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small><?php echo $_SESSION['un']; ?></small>
                    </h1>
<!--                        user online-->
<!--                    --><?php //echo $count_user; ?>

                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                            $query = "select * from posts where post_status='published'";
                                            $pass = mysqli_query($connection, $query);
                                            $post_count = mysqli_num_rows($pass); // gets no of rows
                                            echo "<div class='huge'>{$post_count}</div>";
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                            $query = "select * from comments";
                                            $pass = mysqli_query($connection, $query);
                                            $cmt_count = mysqli_num_rows($pass); // gets no of rows
                                            echo "<div class='huge'>{$cmt_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                            $query = "select * from users";
                                            $pass = mysqli_query($connection, $query);
                                            $usr_count = mysqli_num_rows($pass); // gets no of rows
                                            echo "<div class='huge'>{$usr_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                            $query = "select * from categories";
                                            $pass = mysqli_query($connection, $query);
                                            $cat_count = mysqli_num_rows($pass); // gets no of rows
                                            echo "<div class='huge'>{$cat_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="catagories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
                    $query = "select * from posts where post_status='draft'";
                    $pass = mysqli_query($connection, $query);
                    $post_counts = mysqli_num_rows($pass);

                    $query = "select * from comments where comment_status='unapproved'";
                    $pass = mysqli_query($connection, $query);
                    $cmt_counts = mysqli_num_rows($pass); // gets no of rows

                    $query = "select * from users where user_role='Subscriber'";
                    $pass = mysqli_query($connection, $query);
                    $usr_counts = mysqli_num_rows($pass); // gets no of rows

                    $query = "select * from users where user_role='admin'";
                    $pass = mysqli_query($connection, $query);
                    $usr_countsA = mysqli_num_rows($pass); // gets no of rows
            ?>

            <div class="row">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data ', 'Count'],

                            <?php
                                    $elements_text = ['Active Post','Draft Post', 'Comments', 'Unapproved Comments', 'Users','Admin', 'Subscribers', 'Categories'];
                                    $element_count = [$post_count, $post_counts, $cmt_count, $cmt_counts, $usr_count, $usr_countsA, $usr_counts, $cat_count];

                                    // "['{$elements_text[$i]}']" --> For each text val
                                    //   "$element_count[$i]" --> For each integer value
                                    // general structure defined in API
                                    for ($i = 0; $i < 8; $i++){
                                        echo "['{$elements_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                            ?>
                            //['Post', 1000],
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>