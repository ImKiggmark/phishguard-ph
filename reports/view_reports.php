<?php

session_start();
include("../database/db.php");

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM reports WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>My Reports</title>
</head>

<body>

<h2>My Phishing Reports</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Title</th>
<th>Platform</th>
<th>Link</th>
<th>Risk</th>
<th>Date</th>
<th>Actions</th>
</tr>

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

echo "<tr>
<td>".$row['report_id']."</td>
<td>".$row['title']."</td>
<td>".$row['platform']."</td>
<td>".$row['scam_link']."</td>
<td>".$row['created_at']."</td>
<td>
<a href='edit_report.php?id=".$row['report_id']."'>Edit</a> |
<a href='delete_report.php?id=".$row['report_id']."' onclick='return confirm(\"Are you sure you want to delete this report?\")'>Delete</a>
</td>
</tr>";

}

}else{

echo "<tr><td colspan='6'>No reports submitted yet.</td></tr>";

}

?>

</table>

<br>
<a href="../dashboard.php">Back to Dashboard</a>

</body>
</html>