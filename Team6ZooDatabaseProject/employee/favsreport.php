<?php
// Start the session
session_start();
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
  @$a=$_POST['monthpick'];
 ?> 

  <!DOCTYPE html>
  <html>  
<head></head>  
<title>FavMonths</title>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel = "stylesheet" href = "favsreport.css">
<body> 

<header> <strong> Polling report  </strong> </header>
<form id="monthpick" name="monthpick" method="post" action= "<?php echo $_SERVER['PHP_SELF'];?>">   
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
<input type = "submit", name = "submit", value = "Submit">
</form>  

<?php
 if(@$_POST['submit'])
 {
   $grab1 = "SELECT DISTINCT Animal_Name, Species, COUNT(Ticket_Date) FROM ANIMAL, SELLS_TICKET WHERE Animal_ID = FavAnimal AND MONTH(Ticket_Date) = MONTH('$a') GROUP BY Animal_Name ORDER BY COUNT(Ticket_Date) DESC";
   $grab2 = "SELECT DISTINCT Ex_Name, COUNT(Ticket_Date) FROM EXHIBIT, SELLS_TICKET WHERE Ex_Name = FavExhibit AND MONTH(Ticket_Date) = MONTH('$a') GROUP BY Ex_Name ORDER BY COUNT(Ticket_Date) DESC";
   $result1 = mysqli_query($conn, $grab1);
   $result2 = mysqli_query($conn, $grab2);
   echo "<center>";
   echo "<div> Animal   </div>";
   echo "<table class = 'table table-striped' border='1'>
   <tr>
   <th>Animal Name</th>
   <th>Species</th>
   <th># of Votes</th>

   
   </tr>";
   while($row = mysqli_fetch_array($result1)) //just create some tables to show user tickets bought in the past, all their tickets bought, and the tickets they can vote on (current month and past date)
   {
   echo "<tr>";
   echo "<td>" . $row['Animal_Name'] . "</td>";
   echo "<td>" . $row['Species'] . "</td>";
   echo "<td>" . $row['COUNT(Ticket_Date)'] . "</td>";
   echo "</tr>";
   };
   echo "</table>";
   echo "<div> Exhibit  </div>";
   echo "<table class = 'table table-striped' border='1'>
   <tr>
   <th>Exhibit Name</th>
   <th># of Votes</th>

   
   </tr>";
   while($row = mysqli_fetch_array($result2)) //just create some tables to show user tickets bought in the past, all their tickets bought, and the tickets they can vote on (current month and past date)
   {
   echo "<tr>";
   echo "<td>" . $row['Ex_Name'] . "</td>";
   echo "<td>" . $row['COUNT(Ticket_Date)'] . "</td>";
   echo "</tr>";
   };
   echo "</table>";
   echo "</center>";
};
?>
</body>  
</html>