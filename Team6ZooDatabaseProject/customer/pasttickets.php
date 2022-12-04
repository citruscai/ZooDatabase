<?php
session_start();
include 'header.php';
echo "Hello, " . $_SESSION["email"] . "!<br>";
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
  $result = mysqli_query($conn,"SELECT DATE(`Ticket_Date`) AS `SellDate`, `Voted` FROM `SELLS_TICKET` WHERE `TCustomerEmail` = '$_SESSION[email]' AND DATE(`Ticket_Date`) < DATE(CONVERT_TZ(SYSDATE(),'+00:00', '-06:00'))");
  echo "<table border='1'>
<tr>
<th>Past Tickets</th>

</tr>";
while($row = mysqli_fetch_array($result)) //just create some tables to show user tickets bought in the past, all their tickets bought, and the tickets they can vote on (current month and past date)
{
echo "<tr>";
echo "<td>" . $row['SellDate'] . "</td>";
echo "</tr>";
}
echo "</table>";
$result = mysqli_query($conn,"SELECT DATE(`Ticket_Date`) AS `SellDate`, `Voted` FROM `SELLS_TICKET` WHERE `TCustomerEmail` = '$_SESSION[email]'");
echo "<table border='1'>
<tr>
<th>All Tickets</th>

</tr>";
while($row = mysqli_fetch_array($result)) 
{
echo "<tr>";
echo "<td>" . $row['SellDate'] . "</td>";
echo "</tr>";
}
echo "</table>";
$result = mysqli_query($conn,"SELECT DATE(`Ticket_Date`) AS `SellDate`, `Voted`, `Ticket_ID` FROM `SELLS_TICKET` WHERE `TCustomerEmail` = '$_SESSION[email]' AND MONTH(DATE(`Ticket_Date`)) = MONTH(DATE(CONVERT_TZ(SYSDATE(),'+00:00', '-06:00'))) AND DATE(`Ticket_Date`) < DATE(CONVERT_TZ(SYSDATE(),'+00:00', '-06:00'))");
echo "<table border='1'>
<tr>
<th>VOTE ON THIS MONTH'S TICKETS!</th>

</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
if($row['Voted'] != 1 )
{
    echo "<td>" . "<a href = ballot.php?ticketid=$row[Ticket_ID]> $row[SellDate] <a>" . "</td>"; //sends to voting page that connects with ticket ID
}
else
{
    echo "<td>" . $row['SellDate'] . "</td>";
}
}
echo "</tr>";
echo "</table>";


mysqli_close($conn);