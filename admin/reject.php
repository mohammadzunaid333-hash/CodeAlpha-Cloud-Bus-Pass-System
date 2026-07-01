<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    mysqli_query($conn,"UPDATE applications SET status='Rejected' WHERE id='$id'");

}

header("Location: applications.php");
exit();

?>