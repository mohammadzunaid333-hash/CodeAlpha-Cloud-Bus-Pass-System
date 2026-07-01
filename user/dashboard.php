<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];

$total=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE user_id='$user_id'"));

$approved=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE user_id='$user_id' AND status='Approved'"));

$pending=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE user_id='$user_id' AND status='Pending'"));

$rejected=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE user_id='$user_id' AND status='Rejected'"));

?>

<!DOCTYPE html>
<html>

<head>

<title>User Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#eef2f7;
}

.container{
width:95%;
margin:30px auto;
}

.welcome{
background:#0d6efd;
color:white;
padding:25px;
border-radius:12px;
margin-bottom:25px;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:25px;
text-align:center;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.card h2{
font-size:42px;
margin-bottom:10px;
}

.blue{
border-top:6px solid #0d6efd;
}

.green{
border-top:6px solid green;
}

.orange{
border-top:6px solid orange;
}

.red{
border-top:6px solid red;
}

.actions{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.actions a{
text-decoration:none;
background:white;
padding:20px;
border-radius:10px;
text-align:center;
color:#0d6efd;
font-size:18px;
font-weight:bold;
box-shadow:0 5px 15px rgba(0,0,0,.1);
transition:.3s;
}

.actions a:hover{
background:#0d6efd;
color:white;
}

</style>

</head>

<body>

<div class="container">

<div class="welcome">

<h1>Welcome, <?php echo $user_name; ?></h1>

<p>Cloud Bus Pass System</p>

</div>

<div class="cards">

<div class="card blue">
<h2><?php echo $total; ?></h2>
<p>Total Applications</p>
</div>

<div class="card orange">
<h2><?php echo $pending; ?></h2>
<p>Pending</p>
</div>

<div class="card green">
<h2><?php echo $approved; ?></h2>
<p>Approved</p>
</div>

<div class="card red">
<h2><?php echo $rejected; ?></h2>
<p>Rejected</p>
</div>

</div>

<div class="actions">

<a href="apply_pass.php">🚌 Apply Bus Pass</a>

<a href="my_applications.php">📄 My Applications</a>

<a href="my_pass.php">🎫 My Bus Pass</a>

<a href="renew_pass.php">♻ Renew Pass</a>

<a href="profile.php">👤 My Profile</a>

<a href="print_pass.php">🖨 Print Pass</a>

</div>

</div>

</body>

</html>