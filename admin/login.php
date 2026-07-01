<?php
session_start();
include("../includes/config.php");

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){

        $admin = mysqli_fetch_assoc($result);

        // Temporary login (we'll secure it later)
        if($password == $admin['password']){

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];

            header("Location: dashboard.php");
            exit();

        }else{
            $message = "<p style='color:red;'>Invalid Password!</p>";
        }

    }else{
        $message = "<p style='color:red;'>Invalid Username!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#0d6efd;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.login-box{
width:380px;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,.2);
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
border-radius:6px;
}

button{
width:100%;
padding:12px;
background:#0d6efd;
color:white;
border:none;
border-radius:6px;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#0b5ed7;
}

.message{
text-align:center;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<div class="message">
<?php echo $message; ?>
</div>

<form method="POST">

<input
type="text"
name="username"
placeholder="Username"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">
Login
</button>

</form>

</div>

</body>
</html>