<?php

function confirm($parameter){
    global $connection;
    if (!$parameter){
        die("Error ---> " .mysqli_error($connection));
    }
}

function insert_into(){

    global $connection;

    if (isset($_POST['submit'])){
        $cat_tat = $_POST['cat_title'];
        if ($cat_tat == "" || empty($cat_tat)){
            echo "*field shouldn't be empty";
        } else {
            $query = "insert into categories (cat_title) values('$cat_tat')";
            $create_category = mysqli_query($connection, $query);
            if (!$create_category){
                die("something's going wrong" . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories(){
    global $connection;

    $query = "select * from categories";
    $select_all_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='catagories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='catagories.php?update={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function delete(){
    global $connection;

    if (isset($_GET['delete'])){
        $cat_id_del = $_GET['delete'];
        $queryp = "DELETE FROM categories WHERE cat_id = {$cat_id_del}";
        $lp = mysqli_query($connection, $queryp);
        // refreshes the page, else we need click delete twice
        header("Location: catagories.php");
    } else {
        echo "Sorry";
    }
}

?>