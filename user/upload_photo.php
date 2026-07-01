<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$message="";

if(isset($_POST['upload'])){

    $user_id=$_SESSION['user_id'];

    $filename=$_FILES['photo']['name'];

    $tmp=$_FILES['photo']['tmp_name'];

    move_uploaded_file($tmp,"../uploads/".$filename);

    mysqli_query($conn,"UPDATE users SET photo='$filename' WHERE id='$user_id'");

    $message="Photo Uploaded Successfully";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Upload Photo</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.box{

width:500px;

margin:50px auto;

background:white;

padding:30px;

border-radius:10px;

text-align:center;

}

input{

margin:20px;

}

button{

padding:12px 25px;

background:#0d6efd;

color:white;

border:none;

cursor:pointer;

}

</style>

</head>

<body>

<div class="box">

<h2>Upload Profile Photo</h2>

<p style="color:green;">
<?php echo $message; ?>
</p>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="photo" required>

<br>

<button name="upload">

Upload

</button>

</form>

</div>

</body>

</html>