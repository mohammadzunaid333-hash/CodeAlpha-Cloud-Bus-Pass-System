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

if(isset($_POST['update'])){

    $name=mysqli_real_escape_string($conn,$_POST['full_name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);

    mysqli_query($conn,"
        UPDATE users
        SET
        full_name='$name',
        email='$email',
        phone='$phone'
        WHERE id='$user_id'
    ");

    $message="Profile Updated Successfully!";
}

$user=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM users WHERE id='$user_id'
"));

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Profile</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
}

.box{

width:600px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,.1);

}

input{

width:100%;
padding:12px;
margin:10px 0;

}

button{

width:100%;
padding:12px;
background:#0d6efd;
color:white;
border:none;
font-size:16px;
cursor:pointer;

}

.success{

color:green;
margin-bottom:15px;

}

</style>

</head>

<body>

<div class="box">

<h2>Edit Profile</h2>

<p class="success"><?php echo $message; ?></p>

<form method="POST">

<input
type="text"
name="full_name"
value="<?php echo $user['full_name']; ?>"
required>

<input
type="email"
name="email"
value="<?php echo $user['email']; ?>"
required>

<input
type="text"
name="phone"
value="<?php echo $user['phone']; ?>"
required>

<button
name="update">

Update Profile

</button>

</form>

</div>

</body>

</html>