<?php ob_start(); ?>
<?php include "includes/header.php" ?>
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

                    <?php
                    $source = "";
                    if (isset($_GET['source'])){
                        $source = $_GET['source'];
                    }

                    switch ($source){
                        case 'add_user':
                            include "includes/add_user.php";
                            break;
                        case 'edit_users':
                            include "includes/edit_user.php";
                            break;
                        default:
                            include "includes/view_all_users.php";
                            break;
                    }
                    ?>

                    <?php

                    ?>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>