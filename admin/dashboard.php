<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/admin_navbar.php");

$totalUsers = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$totalApplications = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications"));
$pending = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE status='Pending'"));
$approved = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE status='Approved'"));
$rejected = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications WHERE status='Rejected'"));

$recent = mysqli_query($conn,"
SELECT *
FROM applications
ORDER BY id DESC
LIMIT 10
");
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Admin Dashboard</title>

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
margin-bottom:25px;
color:#0d6efd;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
margin-bottom:35px;
}

.card{
background:white;
border-radius:15px;
padding:30px;
text-align:center;
box-shadow:0 8px 20px rgba(0,0,0,.12);
transition:.3s;
}

.card:hover{
transform:translateY(-8px);
}

.icon{
font-size:50px;
margin-bottom:15px;
}

.card h2{
font-size:40px;
margin-bottom:10px;
}

.card p{
font-size:18px;
font-weight:bold;
}

.users{
border-left:8px solid #0d6efd;
}

.applications{
border-left:8px solid #6f42c1;
}

.pending{
border-left:8px solid orange;
}

.approved{
border-left:8px solid green;
}

.rejected{
border-left:8px solid red;
}

.recent-table{
width:100%;
background:white;
border-collapse:collapse;
border-radius:15px;
overflow:hidden;
box-shadow:0 8px 20px rgba(0,0,0,.12);
}

.recent-table th{
background:#0d6efd;
color:white;
padding:15px;
}

.recent-table td{
padding:14px;
text-align:center;
border-bottom:1px solid #eee;
}

.pendingBadge{
background:orange;
color:white;
padding:6px 15px;
border-radius:20px;
}

.approvedBadge{
background:green;
color:white;
padding:6px 15px;
border-radius:20px;
}

.rejectedBadge{
background:red;
color:white;
padding:6px 15px;
border-radius:20px;
}

</style>

</head>

<body>

<div class="main">

<div class="container">

<h1>📊 Admin Dashboard</h1>

<div class="cards">

<div class="card users">
<div class="icon">👥</div>
<h2><?php echo $totalUsers; ?></h2>
<p>Total Users</p>
</div>

<div class="card applications">
<div class="icon">📄</div>
<h2><?php echo $totalApplications; ?></h2>
<p>Total Applications</p>
</div>

<div class="card pending">
<div class="icon">⏳</div>
<h2><?php echo $pending; ?></h2>
<p>Pending</p>
</div>

<div class="card approved">
<div class="icon">✅</div>
<h2><?php echo $approved; ?></h2>
<p>Approved</p>
</div>

<div class="card rejected">
<div class="icon">❌</div>
<h2><?php echo $rejected; ?></h2>
<p>Rejected</p>
</div>

</div>

<h2 style="margin-bottom:20px;color:#0d6efd;">
Recent Applications
</h2>

<table class="recent-table">

<tr>

<th>Pass ID</th>
<th>Name</th>
<th>Route</th>
<th>Pass Type</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($recent)){ ?>

<tr>

<td><?php echo $row['pass_id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['source']; ?> → <?php echo $row['destination']; ?></td>

<td><?php echo $row['pass_type']; ?></td>

<td>
    <?php

if($row['status']=="Pending"){

echo "<span class='pendingBadge'>Pending</span>";

}
elseif($row['status']=="Approved"){

echo "<span class='approvedBadge'>Approved</span>";

}
else{

echo "<span class='rejectedBadge'>Rejected</span>";

}

?>

</td>

</tr>

<?php } ?>

</table>

<br><br>

<a href="applications.php" style="
background:#0d6efd;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;
font-weight:bold;
margin-right:10px;
">

📄 Manage Applications

</a>

<a href="users.php" style="
background:green;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;
font-weight:bold;
margin-right:10px;
">

👥 View Users

</a>

<a href="export_csv.php" style="
background:#212529;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;
font-weight:bold;
">

⬇ Export CSV

</a>

</div>

</div>

</body>

</html>