<form action="" method="post">

    <div class="form-group">
        <label for="cat-title">Update Category</label>

        <?php
        if (isset($_GET['update'])) {
            $cat_ids = $_GET['update'];
            $query = "select * from categories where cat_id = {$cat_ids}";
            $select_categories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>

                <input value="<?php if (isset($cat_title)){ echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

            <?php }
        }
        ?>

        <?php // update
        if (isset($_POST['updates'])) {
            $cat_id_up = $_POST['cat_title'];
            $queryup = "update categories set cat_title = '{$cat_id_up}' where cat_id = {$cat_ids}";
            $lps = mysqli_query($connection, $queryup);
            if (!$lps){
                die("failed" . mysqli_error($connection));
            }
        }
        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="updates" value="Update">
    </div>
</form>

