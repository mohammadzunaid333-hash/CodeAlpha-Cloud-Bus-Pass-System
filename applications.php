<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location:login.php");
    exit();
}

include("../includes/config.php");
include("../includes/admin_navbar.php");

$search="";

$sql="SELECT * FROM applications";

if(isset($_GET['search']) && $_GET['search']!=""){

    $search=mysqli_real_escape_string($conn,$_GET['search']);

    $sql.=" WHERE full_name LIKE '%$search%'
          OR pass_id LIKE '%$search%'
          OR source LIKE '%$search%'
          OR destination LIKE '%$search%'";
}

$sql.=" ORDER BY id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Applications</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
margin:0;
}

.container{
padding:30px;
}

h1{
margin-bottom:20px;
}

.search{

margin-bottom:20px;

}

.search input{

padding:10px;
width:300px;

}

.search button{

padding:10px 20px;
background:#0d6efd;
color:white;
border:none;
cursor:pointer;

}

table{

width:100%;
background:white;
border-collapse:collapse;

}

th{

background:#0d6efd;
color:white;
padding:12px;

}

td{

padding:12px;
border-bottom:1px solid #ddd;
text-align:center;

}

.approve{

background:green;
color:white;
padding:7px 12px;
text-decoration:none;
border-radius:5px;

}

.reject{

background:red;
color:white;
padding:7px 12px;
text-decoration:none;
border-radius:5px;

}

.delete{

background:#212529;
color:white;
padding:7px 12px;
text-decoration:none;
border-radius:5px;

}

.pending{
color:orange;
font-weight:bold;
}

.approvedStatus{
color:green;
font-weight:bold;
}

.rejectedStatus{
color:red;
font-weight:bold;
}

</style>
.main{
margin-left:260px;
padding:30px;
}

</head>

<body>

<div class="main">

<div class="container">
<h1>Manage Applications</h1>

<form class="search">

<input
type="text"
name="search"
placeholder="Search..."
value="<?php echo $search; ?>">

<button>
Search
</button>

</form>

<table>

<tr>

<th>ID</th>
<th>Pass ID</th>
<th>Name</th>
<th>Phone</th>
<th>Route</th>
<th>Pass</th>
<th>Status</th>
<th>Actions</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['pass_id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['source']; ?> → <?php echo $row['destination']; ?></td>

<td><?php echo $row['pass_type']; ?></td>

<td>

<?php

if($row['status']=="Pending"){
echo "<span class='pending'>Pending</span>";
}
elseif($row['status']=="Approved"){
echo "<span class='approvedStatus'>Approved</span>";
}
else{
echo "<span class='rejectedStatus'>Rejected</span>";
}

?>

</td>

<td>

<a class="approve"
href="approve.php?id=<?php echo $row['id']; ?>">
Approve
</a>

<a class="reject"
href="reject.php?id=<?php echo $row['id']; ?>">
Reject
</a>

<a class="delete"
onclick="return confirm('Delete this application?')"
href="delete.php?id=<?php echo $row['id']; ?>">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>

</html>