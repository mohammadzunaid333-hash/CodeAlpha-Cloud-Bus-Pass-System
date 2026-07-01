<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$message="";

if(isset($_POST['change'])){

    $old=$_POST['old_password'];
    $new=$_POST['new_password'];
    $confirm=$_POST['confirm_password'];

    $result=mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
    $user=mysqli_fetch_assoc($result);

    if($old!=$user['password']){

        $message="<span style='color:red;'>Old Password is Incorrect.</span>";

    }elseif($new!=$confirm){

        $message="<span style='color:red;'>Passwords do not match.</span>";

    }else{

        mysqli_query($conn,"UPDATE users SET password='$new' WHERE id='$user_id'");

        $message="<span style='color:green;'>Password Changed Successfully!</span>";

    }

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Change Password</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
}

.box{

width:500px;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,.1);

}

input{

width:100%;
padding:12px;
margin:12px 0;

}

button{

width:100%;
padding:12px;
background:#0d6efd;
color:white;
border:none;
cursor:pointer;
font-size:16px;

}

</style>

</head>

<body>

<div class="box">

<h2>Change Password</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input
type="password"
name="old_password"
placeholder="Old Password"
required>

<input
type="password"
name="new_password"
placeholder="New Password"
required>

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button
name="change">

Change Password

</button>

</form>

</div>

</body>

</html>