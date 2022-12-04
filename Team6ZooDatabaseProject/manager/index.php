<?php session_start();?>
<!DOCTYPE html>
<html lang = "en">
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel = "stylesheet" href = "index.css">
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




<body id = "index">


<div class = "intro" > Welcome, <strong> Manager </strong> !</div>

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
} 
else { 
  echo "<br>" . "You have 0 notifications!" . "<br>"; 
  echo "</table>";
}


$conn->close();
?>
<a href='index.php?delete' class='btn'>Delete All Notifications</a>
</table>


<div class="manager-icons container">
  <div class="card-deck">
    <div class="card bg" width= 300px>
      <img class="card-img-top" src="images/finance-icon.png" alt="Finance icon" style="width:100%" height="300px">
      <div class="card-body text-center">
      <a href="finances.php" class="btn btn-primary">Finances</a>
      </div>
    </div>

    <div class="card bg" width= 300px>
      <img class="card-img-top" src="images/employee-icon.png" alt="Employee icon" style="width:100%" height="300px">
      <div class="card-body text-center">
      <a href="manageemployees.php" class="btn btn-primary">Manage employees</a>
      </div>
    </div>

    <div class="card bg" width= 300px>
      <img class="card-img-top" src="images/ticket-icon.jpeg" alt="Ticket icon" style="width:100%" height="300px">
      <div class="card-body text-center">
      <a href="zootrafficreport.php" class="btn btn-primary">Ticket sales</a>
      </div>
    </div>

    <div class="card bg" width= 300px>
      <img class="card-img-top" src="https://cdn-icons-png.flaticon.com/512/6828/6828737.png" alt="alet icon" style="width:100%" height="300px">
      <div class="card-body text-center">
      <a href="notifs.php" class="btn btn-primary">Alerts</a>
      </div>
    </div>

  </div>
</div>

<div class = "log-out container">
<a href="../careers/index.php" class="btn btn-primary" height="100px">Log out</a>
</div>
</body>


</html>