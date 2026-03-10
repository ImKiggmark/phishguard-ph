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
<title>Dashboard</title>
</head>

<body>

<h1>Welcome <?php echo $_SESSION['name']; ?></h1>

<p>You are logged in to PhishGuard PH.</p>

<a href="reports/submit_report.php">Submit Phishing Report</a>
<br><br>
<a href="reports/view_reports.php">View My Reports</a>
<br><br>
<a href="index.php">Back to Home</a>
<br><br>
<a href="logout.php">Logout</a>

</body>
</html>