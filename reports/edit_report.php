<?php

session_start();
include("../database/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM reports WHERE report_id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(isset($_POST['update_report'])){

$title = $_POST['title'];
$platform = $_POST['platform'];
$description = $_POST['description'];
$link = $_POST['scam_link'];

$update = "UPDATE reports SET
title='$title',
platform='$platform',
description='$description',
scam_link='$link'
WHERE report_id='$id'";

$conn->query($update);

header("Location: view_reports.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/css/style.css">
<title>Edit Report</title>
</head>

<body>

<?php include("../components/navbar.php"); ?>

<h2>Edit Report</h2>

<form method="POST">

<input type="text" name="title" value="<?php echo $row['title']; ?>" required>
<br><br>

<input type="text" name="platform" value="<?php echo $row['platform']; ?>" required>
<br><br>

<textarea name="description"><?php echo $row['description']; ?></textarea>

<br><br>

<input type="text" name="scam_link" value="<?php echo $row['scam_link']; ?>">

<br><br>

<button type="submit" name="update_report">Update Report</button>

</form>

<br>
<a href="view_reports.php">Back</a>

</body>
</html>