<?php

session_start();
include("../database/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM reports WHERE report_id='$id'";

if($conn->query($sql)){
header("Location: view_reports.php");
}else{
echo "Error deleting report.";
}

?>