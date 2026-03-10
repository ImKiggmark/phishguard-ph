<?php

include("database/db.php");

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')";

if($conn->query($sql)){
echo "Registration Successful!";
}else{
echo "Error: ".$conn->error;
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register - PhishGuard PH</title>
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

.register-container{
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

<div class="register-container">

<h2>Create Account</h2>

<form method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register">Register</button>

</form>

<div class="link">
<a href="login.php">Already have an account?</a>
</div>

</div>

</body>
</html>