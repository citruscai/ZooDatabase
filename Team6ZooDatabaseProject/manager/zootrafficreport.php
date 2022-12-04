<?php
// Start the session
session_start();

$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  echo "<center>";
  @$a=$_POST['monthpick'];
  if(@$_POST['submitday']){
    //$result = mysqli_query($conn,"SELECT COUNT(`Ticket_ID`), DAYOFWEEK(Ticket_Date) FROM `SELLS_TICKET` GROUP BY DAYOFWEEK(Ticket_Date) ORDER BY DAYOFWEEK(Ticket_Date) ASC");
    $result = mysqli_query($conn,"SELECT COUNT(`Ticket_ID`) ,DAYOFWEEK(Ticket_Date) FROM `SELLS_TICKET` GROUP BY DAYOFWEEK(Ticket_Date) ORDER BY DAYOFWEEK(Ticket_Date) ASC");
  echo "<table class = 'table table-striped'  border='1'>
<tr>
<th>Number of Attendees (Based on Tickets) </th> <th>Day of Week of Attendance (All Months) </th>


</tr>";
$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
while($row = mysqli_fetch_array($result)) {//just create some tables to show user tickets bought in the past, all their tickets bought, and the tickets they can vote on (current month and past date)
{
echo "<tr>";
echo "<td>" . $row['COUNT(`Ticket_ID`)'] . "</td>";
echo "<td>" . $days[$row['DAYOFWEEK(Ticket_Date)']-1] . "</td>";
echo "</tr>";
}

  };
  };
  if(@$_POST['submitmonth']){
    $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    $result = mysqli_query($conn,"SELECT COUNT(`Ticket_ID`),COUNT(`Ticket_ID`) ,DAYOFWEEK(Ticket_Date) FROM `SELLS_TICKET` WHERE MONTH(Ticket_Date) = MONTH('$a') GROUP BY DAYOFWEEK(Ticket_Date) ORDER BY DAYOFWEEK(Ticket_Date) ASC");
    echo "<table class = 'table table-striped'  border='1'>
    <tr>
    <th>Number of Attendees (Based on Tickets) </th> <th>Day of Week of Attendance for " . "$a </th> 

</tr>";
$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
while($row = mysqli_fetch_array($result)) {//just create some tables to show user tickets bought in the past, all their tickets bought, and the tickets they can vote on (current month and past date)
{
echo "<tr>";
echo "<td>" . $row['COUNT(`Ticket_ID`)'] . "</td>";
echo "<td>" . $days[$row['DAYOFWEEK(Ticket_Date)']-1] . "</td>";
echo "</tr>";
echo "</center>";
}

  };};
  ?>
  <!DOCTYPE html>
  <html>  
<head></head>  
<title>FavMonths</title>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel = "stylesheet" href = "zootrafficreport.css">
<body> 
<form id="monthpick" name="monthpick" method="post" action= "<?php echo $_SERVER['PHP_SELF'];?>"> 
<div>  
Month :  
<select name ="monthpick">  
<option value="">--- Select ---</option>
  <option value="2022-12-01">2022-12</option> 
  <option value="2022-11-01">2022-11</option> 
  <option value="2022-10-01">2022-10</option>  
  <option value="2022-09-01">2022-09</option>  
  <option value="2022-08-01">2022-08</option>  
  <option value="2022-07-01">2022-07</option>  
  <option value="2022-06-01">2022-06</option>  
  <option value="2022-05-01">2022-05</option>  
</select> 
</div>
<div><input type = "submit", name = "submitmonth", value = "By Month"></div>
</form>  


<form id="daypick" name="daypick" method="post" action= "<?php echo $_SERVER['PHP_SELF'];?>">   
<div>Zoo Traffic By Day  </div>
<div><input type = "submit", name = "submitday", value = "All Time"></div>
</form>
</body>  
</html>