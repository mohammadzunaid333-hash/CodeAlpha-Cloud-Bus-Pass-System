<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

include("../includes/config.php");
include("../includes/navbar.php");

$user_id=$_SESSION['user_id'];

$sql="
SELECT
applications.*,
users.photo
FROM applications
INNER JOIN users
ON applications.user_id=users.id
WHERE
applications.user_id='$user_id'
AND applications.status='Approved'
ORDER BY applications.id DESC
LIMIT 1
";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Digital Bus Pass</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{

background:#eef2f7;
padding:40px;

}

.pass{

width:900px;
margin:auto;
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.15);

}

.header{

background:#0d6efd;
color:white;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;

}

.logo{

font-size:32px;
font-weight:bold;

}

.gov{

text-align:right;

}

.gov h2{

font-size:22px;

}

.gov p{

font-size:14px;

}

.content{

display:flex;
padding:30px;

}

.left{

width:230px;
text-align:center;

}

.left img{

width:180px;
height:210px;
object-fit:cover;
border:4px solid #0d6efd;
border-radius:10px;

}

.right{

flex:1;
padding-left:40px;

}

.title{

font-size:28px;
margin-bottom:20px;
color:#0d6efd;

}

.info{

display:grid;
grid-template-columns:180px auto;
row-gap:18px;
font-size:18px;

}

.label{

font-weight:bold;

}

.status{

margin-top:25px;
display:inline-block;
padding:10px 20px;
background:green;
color:white;
border-radius:30px;
font-weight:bold;

}

.footer{

background:#f4f4f4;
padding:20px;
text-align:center;
font-size:16px;

}

.print{

text-align:center;
margin-top:30px;

}

.print button{

padding:14px 35px;
background:#0d6efd;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
font-size:18px;

}

@media print{

.print{

display:none;

}

body{

background:white;

}

.pass{

box-shadow:none;

}

}

</style>

</head>

<body>

<?php

if(mysqli_num_rows($result)>0){

$row=mysqli_fetch_assoc($result);

?>

<div class="pass">

<div class="header">

<div class="logo">

🚌 Cloud Bus Pass

</div>

<div class="gov">

<h2>Government Transport</h2>

<p>Digital Bus Pass</p>

</div>

</div>

<div class="content">

<div class="left">

<?php

if($row['photo']!=""){

echo "<img src='../uploads/".$row['photo']."'>";

}else{

echo "<img src='https://via.placeholder.com/180x210?text=Photo'>";

}

?>

</div>

<div class="right">

<h2 class="title">

DIGITAL BUS PASS

</h2>

<div class="info">

<div class="label">Pass ID</div>

<div><?php echo $row['pass_id']; ?></div>

<div class="label">Full Name</div>

<div><?php echo $row['full_name']; ?></div>

<div class="label">Phone</div>

<div><?php echo $row['phone']; ?></div>

<div class="label">Source</div>

<div><?php echo $row['source']; ?></div>

<div class="label">Destination</div>

<div><?php echo $row['destination']; ?></div>

<div class="label">Pass Type</div>

<div><?php echo $row['pass_type']; ?></div>
<div class="label">Issue Date</div>

<div><?php echo date("d-m-Y", strtotime($row['applied_at'])); ?></div>

<div class="label">Expiry Date</div>

<div><?php echo date("d-m-Y", strtotime($row['expiry_date'])); ?></div>

<div class="label">Status</div>

<div>

<span class="status">

<?php echo $row['status']; ?>

</span>

</div>

</div>

</div>

</div>

<div class="footer">

<strong>Important Instructions</strong><br><br>

• This Bus Pass is valid only for the approved route.<br>
• Carry a valid College/School ID while travelling.<br>
• Misuse of this pass may lead to cancellation.<br>
• This is a digitally generated bus pass.

</div>

<div class="print">

<button onclick="window.print()">

🖨 Print / Save as PDF

</button>

</div>

</div>

<?php

}else{

?>

<h2 style="text-align:center;color:red;margin-top:80px;">

No Approved Bus Pass Found

</h2>

<?php

}

?>

</body>

</html>