<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<title>Cloud Bus Pass System</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f4f7fc;
}

nav{
background:#0d6efd;
padding:18px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
color:white;
font-size:28px;
font-weight:bold;
margin-left:30px;
}

.menu a{
color:white;
text-decoration:none;
margin-right:25px;
font-size:18px;
}

.hero{

height:85vh;
display:flex;
justify-content:center;
align-items:center;
flex-direction:column;
text-align:center;

background:linear-gradient(rgba(13,110,253,.85),rgba(13,110,253,.85)),
url("https://images.unsplash.com/photo-1516321318423-f06f85e504b3");

background-size:cover;
background-position:center;

color:white;

}

.hero h1{
font-size:55px;
margin-bottom:20px;
}

.hero p{
font-size:22px;
width:70%;
margin-bottom:35px;
}

.btn{

padding:15px 35px;

background:white;

color:#0d6efd;

text-decoration:none;

font-size:20px;

border-radius:8px;

margin:10px;

font-weight:bold;

}

.features{

padding:80px;

background:white;

}

.features h2{

text-align:center;

margin-bottom:40px;

font-size:40px;

}

.cards{

display:flex;

justify-content:space-around;

gap:30px;

}

.card{

background:#f8f9fa;

padding:30px;

border-radius:10px;

width:30%;

text-align:center;

box-shadow:0 5px 15px rgba(0,0,0,.1);

}

.card h3{

margin-bottom:15px;

color:#0d6efd;

}

footer{

background:#212529;

color:white;

text-align:center;

padding:20px;

margin-top:50px;

}

</style>

</head>

<body>

<nav>

<div class="logo">

Cloud Bus Pass

</div>

<div class="menu">

<a href="index.php">Home</a>

<a href="user/login.php">User Login</a>

<a href="admin/login.php">Admin Login</a>

<a href="user/register.php">Register</a>

</div>

</nav>

<section class="hero">

<h1>Cloud Bus Pass System</h1>

<p>

Apply, Manage and Download your Bus Pass Online.
Fast, Secure and Paperless.

</p>

<div>

<a class="btn" href="user/register.php">

Apply Now

</a>

<a class="btn" href="user/login.php">

Login

</a>

</div>

</section>

<section class="features">

<h2>Why Choose Our System?</h2>

<div class="cards">

<div class="card">

<h3>Online Application</h3>

<p>Apply for your bus pass from anywhere.</p>

</div>

<div class="card">

<h3>Secure Cloud Storage</h3>

<p>Your information is stored securely.</p>

</div>

<div class="card">

<h3>Instant Approval</h3>

<p>Track your application and download your pass.</p>

</div>

</div>

</section>

<footer>

© 2026 Cloud Bus Pass System | CodeAlpha Internship Project

</footer>
<script src="assets/js/script.js"></script>
</body>

</html>