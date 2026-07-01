<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"SELECT * FROM applications WHERE user_id='$user_id' ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<title>My Applications</title>

<style>

body{
font-family:Arial;
background:#f5f5f5;
padding:30px;
}

table{
width:100%;
background:white;
border-collapse:collapse;
}

th{
background:#0d6efd;
color:white;
padding:15px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
text-align:center;
}

.pending{
color:orange;
font-weight:bold;
}

.approved{
color:green;
font-weight:bold;
}

.rejected{
color:red;
font-weight:bold;
}

</style>

</head>

<body>

<h2>My Applications</h2>

<table>

<tr>

<th>Pass ID</th>
<th>Source</th>
<th>Destination</th>
<th>Pass Type</th>
<th>Status</th>
<th>Expiry</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['pass_id']; ?></td>

<td><?php echo $row['source']; ?></td>

<td><?php echo $row['destination']; ?></td>

<td><?php echo $row['pass_type']; ?></td>

<td>

<?php

if($row['status']=="Pending"){
echo "<span class='pending'>Pending</span>";
}
elseif($row['status']=="Approved"){
echo "<span class='approved'>Approved</span>";
}
else{
echo "<span class='rejected'>Rejected</span>";
}

?>

</td>

<td><?php echo $row['expiry_date']; ?></td>

</tr>

<?php } ?>

</table>

</body>

</html>