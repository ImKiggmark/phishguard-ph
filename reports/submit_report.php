<?php

session_start();
include("../database/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

if(isset($_POST['submit_report'])){

$title = $_POST['title'];
$platform = $_POST['platform'];
$description = $_POST['description'];
$link = $_POST['scam_link'];
$user_id = $_SESSION['user_id'];

$text = strtolower($title . " " . $description . " " . $link);

$risk = "Low";

if(strpos($text,"bank") !== false ||
   strpos($text,"login") !== false ||
   strpos($text,"verify") !== false ||
   strpos($text,"account") !== false ||
   strpos($text,"password") !== false){
    $risk = "High";
}
elseif(strpos($text,"promo") !== false ||
       strpos($text,"free") !== false ||
       strpos($text,"gcash") !== false){
    $risk = "Medium";
}

$sql = "INSERT INTO reports(title,platform,description,scam_link,user_id,risk_level)
VALUES('$title','$platform','$description','$link','$user_id','$risk')";

if($conn->query($sql)){
echo "Report submitted successfully!";
}else{
echo "Error: ".$conn->error;
}

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Submit Phishing Report</title>
</head>

<body>

<h2>Submit Phishing Report</h2>

<form method="POST">

<input type="text" name="title" placeholder="Report Title" required>
<br><br>

<select name="platform" required>
<option value="">Select Platform</option>
<option>SMS</option>
<option>Email</option>
<option>Facebook</option>
<option>Messenger</option>
<option>Website</option>
</select>

<br><br>

<textarea name="description" placeholder="Describe the phishing message..." required></textarea>

<br><br>

<input type="text" name="scam_link" placeholder="Suspicious Link">

<br><br>

<button type="submit" name="submit_report">Submit Report</button>

</form>

<br>
<a href="../dashboard.php">Back to Dashboard</a>

</body>
</html>