<?php

session_start();
include("database/db.php");

$sql = "SELECT * FROM reports WHERE risk_level='High' ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<h2>Threat Intelligence Feed</h2>

<table border="1" cellpadding="10">

<tr>
<th>Title</th>
<th>Platform</th>
<th>Link</th>
<th>Risk</th>
<th>Date</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>
<td>".$row['title']."</td>
<td>".$row['platform']."</td>
<td>".$row['scam_link']."</td>
<td style='color:red;font-weight:bold;'>".$row['risk_level']."</td>
<td>".$row['created_at']."</td>
</tr>";

}

?>

</table>

<br>
<a href="dashboard.php">Back to Dashboard</a>