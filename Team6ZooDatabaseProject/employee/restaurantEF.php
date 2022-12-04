<?php 
$conn = new mysqli('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }


  // ADD/INSERT INTO DATABASE
  if (isset($_POST['add'])){
    
    $Did = $_POST['R_Dept'];
    $name = $_POST['R_Name'];
    $M_SSN = $_POST['RManagerSSN'];
    $cost = $_POST['R_WeeklyOperationCost'];

    $qry1= "SELECT * FROM DEPARTMENT WHERE Dept_ID='$Did'";
    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result1 = mysqli_query($conn,$qry1);
    $result2 = mysqli_query($conn,$qry2);
    $num_rows1 = mysqli_num_rows($result1);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows1 > 0 && $num_rows2 > 0){
        mysqli_query($conn, "INSERT INTO RESTAURANT (R_Dept, R_Name, RManagerSSN, R_WeeklyOperationCost) VALUES ('$Did', '$name', '$M_SSN', '$cost')");
        echo 'Successfully Added! :D';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: restaurantEF.php?remarks=success");
  }


  // DELETE FROM DATABSE
  if (isset($_POST['delete'])){
    
    $Rid = $_POST['RestaurantID'];
    $name = $_POST['R_Name'];

    $delete = "DELETE FROM RESTAURANT WHERE RestaurantID='$Rid' OR R_Name = '$name'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully Deleted! :D';
    }
    else{
        echo 'Error :(';
    }
  }


  // UPDATE FROM DATABASE
  if (isset($_POST['update'])){
    
    $Rid = $_POST['RestaurantID'];
    $M_SSN = $_POST['RManagerSSN'];
    $cost = $_POST['R_WeeklyOperationCost'];

    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result2 = mysqli_query($conn,$qry2);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows2 > 0){
        mysqli_query($conn, "UPDATE `RESTAURANT` SET `RManagerSSN`='$M_SSN', `R_WeeklyOperationCost`='$cost' WHERE `RestaurantID`='$Rid'");
        echo 'Successfully Updated! :D';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: restaurantEF.php?remarks=success");
  }


  

//VIEWS FROM DATABASE
$view = "SELECT * FROM RESTAURANT";
$result = $conn->query($view);
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        <?php include 'dataEntry.css'; ?>
    </style>
<body style="background-color: #97BB8D;">
<center><br>
    
    <h2>Restaurant</h2>
    <form action="restaurantEF.php" method="POST">

        <label for="R_Dept"> Department No.</label>
        <input type="text" id="R_Dept" name="R_Dept">
    
        <label for="RestaurantID"> Restaurant ID No.</label>
        <input type="text" id="RestaurantID" name="RestaurantID">
        
        <label for="R_Name"> Restaurant Name </label>
        <input type="text" id="R_Name" name="R_Name"><br><br>

        <label for="RManagerSSN"> Manager SSN</label>
        <input type="text" id="RManagerSSN" name="RManagerSSN">

        <label for="R_WeeklyOperationCost"> Weekly Cost</label>
        <input type="text" id="R_WeeklyOperationCost" name="R_WeeklyOperationCost"><br><br>

        <input type = "submit" name = "add" value = "Add">

        <input type = "submit" onclick="verifyyy()" name = "delete" value = "Delete">
            <script language="javascript">
                function verifyyy()
                {
                    var txt;
                    if (confirm("Are you sure you want to delete?" ))
                    {
                        txt = "Suceessfully Deleted! :D";
                    }
                    else{
                        txt = "Canceled";
                    }
                }
            </script>


        <input type = "submit" name = "update" value = "Update">  <br><br><br><br><br>
    
    </form>
    <!-- TABLES -->
    <div class="restaurant">
            <table>
                <tr>
                    <th>Department ID</th>
                    <th>Restaurant ID</th>
                    <th>Restaurant Name</th>
                    <th>Manager SSN</th>
                    <th>Weekly Cost</th>
                </tr>
                <?php
                
                while($row=$result->fetch_assoc())
                {
                ?>
                    <tr>
                        <td><?php echo $row["R_Dept"]; ?></td>
                        <td><?php echo $row["RestaurantID"]; ?></td>
                        <td><?php echo $row["R_Name"]; ?></td>
                        <td><?php echo $row["RManagerSSN"]; ?></td>
                        <td><?php echo $row["R_WeeklyOperationCost"]; ?></td>
                    </tr>
                <?php
                }
                ?>
                
            </table>
        </div>
    
        
</center>
</body>
</html>