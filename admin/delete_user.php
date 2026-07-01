<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

}

header("Location: users.php");
exit();
?>