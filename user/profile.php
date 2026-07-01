<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>My Profile</title>

<style>

body{
font-family:Arial,sans-serif;
background:#f4f7fc;
}

.container{
width:600px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

h2{
color:#0d6efd;
margin-bottom:20px;
text-align:center;
}

table{
width:100%;
}

td{
padding:12px;
font-size:18px;
}

.label{
font-weight:bold;
width:180px;
}

</style>

</head>

<body>

<div class="container">

<h2>My Profile</h2>

<table>

<tr>
<td class="label">Full Name</td>
<td><?php echo $user['full_name']; ?></td>
</tr>

<tr>
<td class="label">Email</td>
<td><?php echo $user['email']; ?></td>
</tr>

<tr>
<td class="label">Phone</td>
<td><?php echo $user['phone']; ?></td>
</tr>

<tr>
<td class="label">Member Since</td>
<td><?php echo $user['created_at']; ?></td>
</tr>

</table>

</div>

</body>
</html>