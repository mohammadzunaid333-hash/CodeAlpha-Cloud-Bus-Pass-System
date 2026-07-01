<?php
session_start();
include("../includes/config.php");

$message = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];

            header("Location: dashboard.php");
            exit();

        }else{
            $message = "<p style='color:red;'>Incorrect Password!</p>";
        }

    }else{
        $message = "<p style='color:red;'>Email not found!</p>";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Login</title>

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
background:#fff;
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
text-align:center;
margin-bottom:10px;
}

.register-link{
text-align:center;
margin-top:15px;
}

.register-link a{
text-decoration:none;
color:#0d6efd;
}

</style>

</head>

<body>

<div class="container">

<h2>User Login</h2>

<div class="message">
<?php echo $message; ?>
</div>

<form method="POST">

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="register-link">
Don't have an account?
<a href="register.php">Register</a>
</div>

</div>

</body>
</html>