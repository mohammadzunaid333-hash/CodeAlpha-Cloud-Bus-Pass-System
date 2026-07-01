<?php
include("../includes/config.php");

$message = "";

if(isset($_POST['register'])){

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password){
        $message = "<p style='color:red;'>Passwords do not match!</p>";
    } else {

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            $message = "<p style='color:red;'>Email already registered!</p>";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(full_name,email,phone,password)
                    VALUES('$full_name','$email','$phone','$hashedPassword')";

            if(mysqli_query($conn,$sql)){
                $message = "<p style='color:green;'>Registration Successful!</p>";
            } else{
                $message = "<p style='color:red;'>Something went wrong.</p>";
            }

        }

    }

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#f4f4f4;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.container{
width:400px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.2);
}

h2{
text-align:center;
margin-bottom:20px;
color:#0d6efd;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

button{
width:100%;
padding:12px;
background:#0d6efd;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
font-size:16px;
}

button:hover{
background:#084298;
}

.message{
margin-bottom:10px;
text-align:center;
}

</style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<div class="message">
<?php echo $message; ?>
</div>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="password" name="password" placeholder="Password" required>

<input type="password" name="confirm_password" placeholder="Confirm Password" required>

<button type="submit" name="register">Register</button>

</form>

</div>

</body>
</html>