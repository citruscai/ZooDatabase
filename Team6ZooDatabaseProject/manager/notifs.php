<!DOCTYPE html>
<html>
<head>
<title>Manager Alerts</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
body{
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
</style>

</head>
<h1> MANAGER ALERTS</h1>
<body>
<table>
<tr>
<th>Date</th>
<th>Notification</th>

</tr>
<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com','admin','team6database','README_RECOVER_DATABASES2');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['delete'])){
    mysqli_query($conn, "DELETE FROM `NOTIFICATIONS`");
 }
$sql = "SELECT NMessage, NDate  FROM NOTIFICATIONS";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["NDate"]. "</td><td>" . $row["NMessage"] . "</td><td>"
. "</td>
</tr>";
}
echo "</table>";
} else { echo "0 results"; }


$conn->close();
?>
<a href='notifs.php?delete' class='btn'>delete</a>
</table>
</body>
</html>