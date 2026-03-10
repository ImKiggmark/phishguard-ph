<?php

session_start();
include("../database/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
header("Location: ../login.php");
exit();
}

$sql = "SELECT * FROM reports ORDER BY
CASE
WHEN risk_level='High' THEN 1
WHEN risk_level='Medium' THEN 2
ELSE 3
END,
created_at DESC";
$result = $conn->query($sql);

?>

<h1>Admin Dashboard</h1>

<p>Welcome Admin <?php echo $_SESSION['name']; ?></p>

<h2>All Phishing Reports</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Title</th>
<th>Platform</th>
<th>Link</th>
<th>User ID</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>
<td>".$row['report_id']."</td>
<td>".$row['title']."</td>
<td>".$row['platform']."</td>
<td>".$row['scam_link']."</td>
<td>".$row['user_id']."</td>
<td>".$row['created_at']."</td>
<td>
<a href='../reports/delete_report.php?id=".$row['report_id']."'>Delete</a>
</td>
</tr>";

}

?>

</table>

<br><br>

<a href="../logout.php">Logout</a>