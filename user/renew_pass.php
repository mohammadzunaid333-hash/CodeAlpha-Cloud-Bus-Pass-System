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

if(isset($_POST['renew'])){

    $id=$_POST['application_id'];

    mysqli_query($conn,"
        UPDATE applications
        SET
        status='Pending'
        WHERE id='$id'
    ");

    $message="Renew Request Sent Successfully!";
}

$result=mysqli_query($conn,"
SELECT * FROM applications
WHERE user_id='$user_id'
AND status='Approved'
");
?>

<!DOCTYPE html>

<html>

<head>

<title>Renew Bus Pass</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.box{

width:700px;

margin:40px auto;

background:white;

padding:30px;

border-radius:10px;

}

table{

width:100%;

border-collapse:collapse;

}

th{

background:#0d6efd;

color:white;

padding:12px;

}

td{

padding:12px;

text-align:center;

border-bottom:1px solid #ddd;

}

button{

padding:10px 20px;

background:green;

color:white;

border:none;

cursor:pointer;

}

</style>

</head>

<body>

<div class="box">

<h2>Renew Bus Pass</h2>

<p style="color:green;"><?php echo $message; ?></p>

<table>

<tr>

<th>Pass ID</th>

<th>Route</th>

<th>Expiry</th>

<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['pass_id']; ?></td>

<td><?php echo $row['source']; ?> → <?php echo $row['destination']; ?></td>

<td><?php echo $row['expiry_date']; ?></td>

<td>

<form method="POST">

<input type="hidden"
name="application_id"
value="<?php echo $row['id']; ?>">

<button
name="renew">

Renew

</button>

</form>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>