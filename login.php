<?php

session_start();
include("database/db.php");

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

if($user['role'] == "admin"){
header("Location: admin/admin_dashboard.php");
}else{
header("Location: dashboard.php");
}

exit();

}else{
echo "Incorrect password.";
}

}else{
echo "User not found.";
}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="assets/css/style.css">
<meta charset="UTF-8">
<title>Login - PhishGuard PH</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body{
font-family: Inter, sans-serif;
background:#f1f5f9;
display:flex;
align-items:center;
justify-content:center;
height:100vh;
}

.login-container{
background:white;
padding:40px;
border-radius:10px;
width:350px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

h2{
text-align:center;
margin-bottom:20px;
color:#1d4ed8;
}

input{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

button{
width:100%;
padding:10px;
background:#1d4ed8;
border:none;
color:white;
font-weight:bold;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#1e3a8a;
}

.link{
text-align:center;
margin-top:10px;
}

</style>
</head>

<body>

<div class="login-container">

<h2>PhishGuard PH Login</h2>

<form method="POST">

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="link">
<a href="register.php">Create an account</a>
</div>

</div>

</body>
</html>