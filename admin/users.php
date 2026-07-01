<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/admin_navbar.php");

$search="";

$sql="SELECT * FROM users";

if(isset($_GET['search']) && $_GET['search']!=""){

    $search=mysqli_real_escape_string($conn,$_GET['search']);

    $sql.=" WHERE full_name LIKE '%$search%'
          OR email LIKE '%$search%'
          OR phone LIKE '%$search%'";
}

$sql.=" ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Manage Users</title>

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

h1{
color:#0d6efd;
margin-bottom:20px;
}

.search-box{
margin-bottom:25px;
}

.search-box input{
width:350px;
padding:12px;
border:1px solid #ccc;
border-radius:6px;
}

.search-box button{
padding:12px 20px;
background:#0d6efd;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

table{
width:100%;
background:white;
border-collapse:collapse;
box-shadow:0 8px 20px rgba(0,0,0,.1);
border-radius:12px;
overflow:hidden;
}

th{
background:#0d6efd;
color:white;
padding:15px;
}

td{
padding:14px;
text-align:center;
border-bottom:1px solid #eee;
}

tr:hover{
background:#f8f9fa;
}

.delete{
background:red;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:5px;
}

.edit{
background:green;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:5px;
}

</style>

</head>

<body>

<div class="main">

<div class="container">

<h1>👥 Manage Users</h1>

<form class="search-box" method="GET">

<input
type="text"
name="search"
placeholder="Search by Name, Email or Phone"
value="<?php echo $search; ?>">

<button type="submit">

Search

</button>

</form>

<table>

<tr>

<th>ID</th>
<th>Full Name</th>
<th>Email</th>
<th>Phone</th>
<th>Joined</th>
<th>Actions</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo date("d-m-Y",strtotime($row['created_at'])); ?></td>

<td>
    <?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/admin_navbar.php");

$search="";

$sql="SELECT * FROM users";

if(isset($_GET['search']) && $_GET['search']!=""){

    $search=mysqli_real_escape_string($conn,$_GET['search']);

    $sql.=" WHERE full_name LIKE '%$search%'
          OR email LIKE '%$search%'
          OR phone LIKE '%$search%'";
}

$sql.=" ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Manage Users</title>

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

h1{
color:#0d6efd;
margin-bottom:20px;
}

.search-box{
margin-bottom:25px;
}

.search-box input{
width:350px;
padding:12px;
border:1px solid #ccc;
border-radius:6px;
}

.search-box button{
padding:12px 20px;
background:#0d6efd;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

table{
width:100%;
background:white;
border-collapse:collapse;
box-shadow:0 8px 20px rgba(0,0,0,.1);
border-radius:12px;
overflow:hidden;
}

th{
background:#0d6efd;
color:white;
padding:15px;
}

td{
padding:14px;
text-align:center;
border-bottom:1px solid #eee;
}

tr:hover{
background:#f8f9fa;
}

.delete{
background:red;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:5px;
}

.edit{
background:green;
color:white;
padding:8px 15px;
text-decoration:none;
border-radius:5px;
}

</style>

</head>

<body>

<div class="main">

<div class="container">

<h1>👥 Manage Users</h1>

<form class="search-box" method="GET">

<input
type="text"
name="search"
placeholder="Search by Name, Email or Phone"
value="<?php echo $search; ?>">

<button type="submit">

Search

</button>

</form>

<table>

<tr>

<th>ID</th>
<th>Full Name</th>
<th>Email</th>
<th>Phone</th>
<th>Joined</th>
<th>Actions</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo date("d-m-Y",strtotime($row['created_at'])); ?></td>

<td>