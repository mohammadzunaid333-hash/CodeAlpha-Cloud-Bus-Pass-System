<?php

session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $pass_id = "CBP".date("Y").rand(1000,9999);

    $expiry = date("Y-m-d", strtotime("+30 days"));

    mysqli_query($conn,"
        UPDATE applications
        SET
            status='Approved',
            pass_id='$pass_id',
            expiry_date='$expiry'
        WHERE id='$id'
    ");

}

header("Location: applications.php");
exit();

?>