<?php session_start();?>
<!DOCTYPE html>
<?php include 'header.php';
@include 'config.php'; ?>





<?php




/*$user = 'admin';
$password = 'team6database';


$database = 'README_RECOVER_DATABASES2';


$servername='team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com';
$mysqli = new mysqli($servername, $user,
				$password, $database);*/
$name = $_SESSION["email"]; 				
$mysqli = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com','admin','team6database','README_RECOVER_DATABASES2');
// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

if(isset($_POST['order_btn'])){
	// $g_id = $_POST['g_id'];
	$email = $_POST['email'];
	$method = $_POST['method'];
	$ticketdate = $_POST['ticketdate'];
	$quantity = $_POST['quantity'];
	$price_total = 10;

  
	 //$insert_query = mysqli_query($conn, "INSERT INTO `SELLS_TICKET`(TCustomerEmail, Price,Ticket_Date, quantity ) VALUES('$email', '$price_total', '$ticketdate','$quantity')") or die('query failed');
	 for ($quantity; $quantity>0; $quantity--) //for loop, inserts new row into sells ticket quantity amount of times
	 {
	 
	 	$ticketsleftquery = mysqli_query($conn, "SELECT Tickets_Left FROM TICKET_INVENTORY WHERE `Date` LIKE '$ticketdate%'"); //get amount of tickets left for the date before each insert
	 	$ticketsleft = $ticketsleftquery->fetch_assoc()['Tickets_Left'];
	 	if ($ticketsleft > 0){ //insert if enough
	 		$insert_query = mysqli_query($conn, "INSERT INTO `SELLS_TICKET`(TCustomerEmail, Price,Ticket_Date) VALUES('$email', '$price_total', '$ticketdate')") or die('query failed');

	 	}
	 	else //stop here, might have to write some code here
	 	{
	 		echo "No more tickets left!!!";
	 		break;
	 	}
	}
	 //if($insert_query){
		
		//$message[] = 'See you there';
	// }else{
		//$message[] = 'could not buy ticket';
	// }
  };

  

// SQL query to select data from database
$sql = " SELECT * FROM TICKET_INVENTORY  ";
$result2 = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 
<link rel="stylesheet" href="giftshopstyle.css?v=<?php echo time(); ?>">
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

</head>
<h1> CUSTOMER ALERTS</h1>
<body>
<table>
<tr>
<th>Email</th>
<th>Notification</th>

</tr>
<?php
if ($sqlemail = $_SESSION["email"]) {
    echo "Welcome ";
    echo $_SESSION["email"] . "<br>";
}
//$currentuseremail = $_SESSION["useremail"];
//$currentuseremail = 'voter1@test.com';
//$testlegs = 'break my legs';
//$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com','admin','team6database','README_RECOVER_DATABASES2');
// Check connection
$name = $_SESSION["email"]; 
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['delete'])){
    mysqli_query($conn, "DELETE FROM `CUSTOMER_NOTIFICATIONS` WHERE CN_Email='$name'");
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

$conn->close();
?>
<a href='ticketpurchase.php?delete' class='btn'>Delete Your Customer Notifications</a>
</table>
</body>
<h1>BUY TICKETS HERE</h1>
<section class="checkout-form">

   

   <form action="" method="post">
</div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
			<span>ticket price: $15<span>
         </div>
         
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
			<input type="number" placeholder="number of tickets"id="quantity" name="quantity" min="1" max="100">select id="myselect">
			
			<label for="ticketdate">Date:</label>
  <input type="date" id="ticketdate" name="ticketdate">
<!--



         </div>
		 <div class="inputBox">
            <span>Ticket Date</span>
            <select name="ticketdate">
               
               <option value="2022-11-15 00:00:00">2022-11-15 00:00:00</option>
               <option value="2022-11-16 00:00:00">2022-11-16 00:00:00</option>
			   <option value="2022-11-17 00:00:00">2022-11-17 00:00:00</option>
               <option value="2022-11-18 00:00:00">2022-11-18 00:00:00</option>
			   <option value="2022-11-19 00:00:00">2022-11-18 00:00:00</option>
            </select>
         </div>
-->

         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>
	<meta charset="UTF-8">
	<title>Ticket</title>
	<!-- CSS FOR STYLING THE PAGE -->
	
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			
		}

		td {
			
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			
		}
	</style>
	
</head>

<body>
	<section>
		<h1>ZOO SCHEDULE</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Ticket Date</th>
				<th>Tickets Available</th>
				<
				
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result2->fetch_assoc())
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<td><?php echo $rows['Date'];?></td>
				<td><?php echo $rows['Tickets_Left'];?></td>
				
				
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>



  
  </html>
