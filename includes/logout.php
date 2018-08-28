<?php
session_start();
?>

<?php
$_SESSION['un'] = null;
$_SESSION['fn'] = null;
$_SESSION['ln'] = null;
$_SESSION['rl'] = null;
?>

<?php header("Location:../index.php");