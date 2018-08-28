<?php include "includes/header.php" ?>

    <div id="wrapper">

    <!-- Navigation -->
<?php include "includes/navigation.php"?>

    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome Admin
                    <small>Author</small>
                </h1>

                <div class="col-xs-6">
                    <?php insert_into(); // from functions.php ?>

                    <form action="catagories.php" method="post">

                        <div class="form-group">
                            <label for="cat-title">Add category</label>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add">
                        </div>
                    </form>
                    <?php
                    // update

                    if (isset($_GET['update'])){
                        $cat_ids = $_GET['update'];

                        include "update_categories.php";
                    }
                    ?>
                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                            <th>Category Delete</th>
                            <th>Category Update</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            //////////////////////////////////////////////////////// find all query
                            find_all_categories();
                            ?>
                            <?php
                            ///////////////////////////////////////////////////////// delete
                            delete();
                            ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>