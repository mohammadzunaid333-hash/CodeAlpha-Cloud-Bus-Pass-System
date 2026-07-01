<?php
session_start();
include("../includes/config.php");
include("../includes/navbar.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['apply'])){

    $user_id = $_SESSION['user_id'];

    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $pass_type = $_POST['pass_type'];

    $sql="INSERT INTO applications
    (user_id,full_name,age,gender,phone,address,source,destination,pass_type)
    VALUES
    ('$user_id','$full_name','$age','$gender','$phone','$address','$source','$destination','$pass_type')";

    if(mysqli_query($conn,$sql)){
        $message="<p style='color:green;'>Application Submitted Successfully!</p>";
    }else{
        $message="<p style='color:red;'>Something went wrong.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Apply Bus Pass</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{
width:700px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.2);
}

input,select,textarea{
width:100%;
padding:12px;
margin:10px 0;
}

button{
width:100%;
padding:12px;
background:#007bff;
color:white;
border:none;
cursor:pointer;
font-size:16px;
}

button:hover{
background:#0056b3;
}

</style>

</head>

<body>

<div class="container">

<h2>Apply for Bus Pass</h2>

<?php echo $message; ?>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="number" name="age" placeholder="Age" required>

<select name="gender" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

<input type="text" name="phone" placeholder="Phone Number" required>

<textarea name="address" placeholder="Address" required></textarea>

<input type="text" name="source" placeholder="Source" required>

<input type="text" name="destination" placeholder="Destination" required>

<select name="pass_type" required>
<option value="">Select Pass Type</option>
<option>Daily</option>
<option>Monthly</option>
<option>Quarterly</option>
<option>Yearly</option>
</select>

<button type="submit" name="apply">Submit Application</button>

</form>

</div>

</body>
</html>