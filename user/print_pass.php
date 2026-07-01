<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"
SELECT * FROM applications
WHERE user_id='$user_id'
AND status='Approved'
ORDER BY id DESC
LIMIT 1
");

if(mysqli_num_rows($result)==0){
    die("No Approved Bus Pass Found.");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Print Bus Pass</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.card{
width:700px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 15px rgba(0,0,0,.2);
}

table{
width:100%;
}

td{
padding:10px;
font-size:18px;
}

button{
margin-top:20px;
padding:12px 25px;
background:#0d6efd;
color:white;
border:none;
cursor:pointer;
font-size:18px;
}

@media print{

button{
display:none;
}

body{
background:white;
}

.card{
box-shadow:none;
}

}

</style>

</head>

<body>

<div class="card">

<h2 align="center">Cloud Bus Pass</h2>

<hr>

<table>

<tr>
<td><b>Pass ID</b></td>
<td><?php echo $row['pass_id']; ?></td>
</tr>

<tr>
<td><b>Name</b></td>
<td><?php echo $row['full_name']; ?></td>
</tr>

<tr>
<td><b>Source</b></td>
<td><?php echo $row['source']; ?></td>
</tr>

<tr>
<td><b>Destination</b></td>
<td><?php echo $row['destination']; ?></td>
</tr>

<tr>
<td><b>Pass Type</b></td>
<td><?php echo $row['pass_type']; ?></td>
</tr>

<tr>
<td><b>Expiry Date</b></td>
<td><?php echo $row['expiry_date']; ?></td>
</tr>

</table>

<center>

<button onclick="window.print()">
Print Bus Pass
</button>

</center>

</div>

</body>
</html>