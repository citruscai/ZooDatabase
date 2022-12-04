<?php session_start();
$name = $_SESSION["email"];  ?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Alerts</title>
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
</style>

<?php include 'header.php'; ?>
</head>
<h1> CUSTOMER ALERTS</h1>
<body>
<table>
<tr>
<th>Email</th>
<th>Notification</th>

</tr>
<?php
//$currentuseremail = $_SESSION["useremail"];
//$currentuseremail = 'voter1@test.com';
//$testlegs = 'break my legs';
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com','admin','team6database','README_RECOVER_DATABASES2');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['delete'])){
    mysqli_query($conn, "DELETE * FROM `CUSTOMER_NOTIFICATIONS` WHERE CN_Email='$name'");
 }
//$sql = "SELECT GD_Email, GD_Message  FROM GROUP_DISCOUNT";
          // sets the name in a variable

// SELECT sql query
$sql = "SELECT CN_Email, CN_Message FROM CUSTOMER_NOTIFICATIONS WHERE CN_Email='$name' OR CN_Email = 'all'";

//$sql = "SELECT `GD_Email`, `GD_Message`  FROM `GROUP_DISCOUNT` WHERE `GD_Email` = 'voter1@test.com'";
//$sqlemail = "SELECT GD_Email  FROM GROUP_DISCOUNT WHERE GD_Email = $currentuseremail";
$result = $conn->query($sql);
//$result2 = $conn->query($sqlemail);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["CN_Email"]. "</td><td>" . $row["CN_Message"] . "</td><td>"
. "</td>
</tr>";
}
echo "</table>";
} else { 
    echo "<br>" . "You have 0 notifications!" . "<br>"; 
    echo "</table>";
}
/*
if ($sqlemail = $_SESSION["useremail"]) {
    echo "hello there" . "!<br>";
    echo "||" . $currentuseremail . "||<br>";
   // echo $result  . "!<br>";
    //echo $sqlemail . "!<br>";
    echo $_SESSION["useremail"] . "<br>";
}*/

$conn->close();
?>
</table>
</body>
</html>