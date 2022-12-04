<?php
session_start();
// Start the session 
// Echo session variables that were set on previous page
$ticketidvote=$_GET['ticketid'];
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error; //code uses radio buttons, submit doesn nothing unless you pick both options, then submits data to sells ticket line, returns you to page, link is gone showing you cant vote again on that ticket
    exit();
  }
  $result1 = mysqli_query($conn,"SELECT Animal_ID, Animal_Name, Species FROM ANIMAL");
  $result2 = mysqli_query($conn,"SELECT Ex_Name FROM EXHIBIT");
?>
<?php 
@$a=$_POST['favanimal'];  
@$b=$_POST['favexhibit'];  
if(@$_POST['submit'] && $a != 0 && $b != "")  
{  
 $s="UPDATE `SELLS_TICKET` SET `FavAnimal` = '$a', `Voted` = '1' WHERE `Ticket_ID` = '$ticketidvote'";  
 $t = "UPDATE `SELLS_TICKET` SET `FavExhibit` = '$b' WHERE `Ticket_ID` = '$ticketidvote'";  
mysqli_query($conn, $s);
mysqli_query($conn, $t);
header('location:pasttickets.php');
} ?>
<?php echo "Hello, " . $_SESSION["email"] . "!<br>"; ?>
<!DOCTYPE html>
<html>
<body>
<body style="background-color: #97BB8D; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto;">
<form method="post">
  <p>Pick your favorite Animal!</p>
  <?php while($row = mysqli_fetch_array($result1)){
    ?>
   <input type = "radio", id= "<?php echo $row['Animal_Name']?>", name="favanimal" value="<?php echo $row['Animal_ID']?>">
    <label for = "<?php echo $row['Animal_Name']?>"> <?php echo $row['Animal_Name'] . ' ' . '(' . $row['Species'] . ')'?> </label><br>
    <?php } ?>
  <br>
  <p>Pick your favorite Exhibit!</p>
  <?php while($row = mysqli_fetch_array($result2)){
    ?>
   <input type = "radio", id= "<?php echo $row['Ex_Name']?>", name="favexhibit" value="<?php echo $row['Ex_Name']?>">
    <label for = "<?php echo $row['Ex_Name']?>"> <?php echo $row['Ex_Name']?> </label><br>
    <?php } ?>
  <br>
  <input type = "submit", name = "submit", value = "Submit">
</body>
</html>
