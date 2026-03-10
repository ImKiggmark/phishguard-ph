<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

include("database/db.php");

$user_id = $_SESSION['user_id'];

$total = $conn->query("SELECT COUNT(*) as total FROM reports WHERE user_id='$user_id'")->fetch_assoc()['total'];

$high = $conn->query("SELECT COUNT(*) as high FROM reports WHERE user_id='$user_id' AND risk_level='High'")->fetch_assoc()['high'];

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/css/style.css">
<title>Dashboard</title>

<style>

body{
font-family: Inter, sans-serif;
background:#f1f5f9;
padding:40px;
}

.dashboard{
background:white;
padding:30px;
border-radius:10px;
width:420px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.dashboard a{
display:block;
margin-top:10px;
color:#1d4ed8;
font-weight:bold;
text-decoration:none;
}

.dashboard a:hover{
text-decoration:underline;
}

</style>

</head>

<body>

<?php include("components/navbar.php"); ?>

<div class="container">

<div class="card">

<h1>Welcome <?php echo $_SESSION['name']; ?></h1>

<p>You are logged in to PhishGuard PH.</p>

<h3>Your Report Statistics</h3>

<p>Total Reports: <?php echo $total; ?></p>
<p>High Risk Reports: <?php echo $high; ?></p>

<a class="btn" href="reports/submit_report.php">Submit Phishing Report</a>

<a class="btn" href="reports/view_reports.php">View My Reports</a>

<a class="btn" href="threat_feed.php">Threat Intelligence Feed</a>

</div>

</div>

</body>
</html>