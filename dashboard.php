<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
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
<a href="logout.php">Logout</a>

</body>
</html>