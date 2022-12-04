<?php 
$conn = new mysqli('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  // ADD/INSERT INTO DATABASE
  if (isset($_POST['add'])){
    
    $Did = $_POST['GDept_ID'];
    $Gid = $_POST['GiftshopID'];
    $name = $_POST['Giftshop_Name'];
    $M_SSN = $_POST['GManagerSSN'];
    $cost = $_POST['GShop_Weekly_Operation_Cost'];

    $qry1= "SELECT * FROM DEPARTMENT WHERE Dept_ID='$Did'";
    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result1 = mysqli_query($conn,$qry1);
    $result2 = mysqli_query($conn,$qry2);
    $num_rows1 = mysqli_num_rows($result1);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows1 > 0 && $num_rows2 > 0){
        mysqli_query($conn, "INSERT INTO GIFTSHOP (GDept_ID, GiftshopID, Giftshop_Name, GManagerSSN, GShop_Weekly_Operation_Cost) VALUES ('$Did', '$Gid', '$name', '$M_SSN', '$cost')");
        echo 'Successfully Added! :D';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: giftshopEF.php");
  }


  // DELETE FROM DATABSE
  if (isset($_POST['delete'])){
    
    $Gid = $_POST['GiftshopID'];

    $delete = "DELETE FROM GIFTSHOP WHERE GiftshopID='$Gid'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully Deleted! :D';
    }
    else{
        echo 'Error :(';
    }
  }


  // UPDATE FROM DATABASE
  if (isset($_POST['update'])){
    
    $Gid = $_POST['GiftshopID'];
    $M_SSN = $_POST['GManagerSSN'];
    $cost = $_POST['GShop_Weekly_Operation_Cost'];

    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result2 = mysqli_query($conn,$qry2);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows2 > 0){
        mysqli_query($conn, "UPDATE `GIFTSHOP` SET `GManagerSSN`='$M_SSN', `GShop_Weekly_Operation_Cost`= '$cost' WHERE `GiftshopID`='$Gid'");
        echo 'Successfully Updated! :D';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: giftshopEF.php");
  }


  

//VIEWS FROM DATABASE
$view = "SELECT * FROM GIFTSHOP";
$result = $conn->query($view);
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        <?php include 'dataEntry.css'; ?>
    </style>
</head>
<body style="background-color: #97BB8D; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto;">
<center><br>
    <h2>Gift Shop</h2><br>
    <form action="giftshopEF.php" method="POST">
        <label for="GDept_ID"> Department ID No.</label>
        <input type="text" id="GDept_ID" name="GDept_ID">
    
        <label for="Giftshop_Name"> Name of Gift Shop </label>
        <input type="text" id="Giftshop_Name" name="Giftshop_Name">

        <label for="GiftshopID"> Gift Shop ID No.</label>
        <input type="text" id="GiftshopID" name="GiftshopID"><br><br>

        <label for="GManagerSSN"> Manager SSN </label>
        <input type="text" id="GManagerSSN" name="GManagerSSN">

        <label for="GShop_Weekly_Operation_Cost"> Weekly Cost</label>
        <input type="text" id="GShop_Weekly_Operation_Cost" name="GShop_Weekly_Operation_Cost"><br><br>

        <input type = "submit" name = "add" value = "Add">

        <input type = "submit" onclick="verify()" name = "delete" value = "Delete">
            <script language="javascript">
                function verify()
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


        <input type = "submit" name = "update" value = "Update"> <br><br><br><br><br>
    </form>
  <!-- TABLES -->
    <div class="animalTable">
            <table>
                <tr>
                    <th>Department ID</th>
                    <th>Gift Shop ID</th>
                    <th>Gift Shop Name</th>
                    <th>Manager SSN</th>
                    <th>Weekly Cost</th>
                </tr>
                <?php
                
                while($row=$result->fetch_assoc())
                {
                ?>
                    <tr>
                        <td><?php echo $row["GDept_ID"]; ?></td>
                        <td><?php echo $row["GiftShopID"]; ?></td>
                        <td><?php echo $row["Giftshop_Name"]; ?></td>
                        <td><?php echo $row["GManagerSSN"]; ?></td>
                        <td><?php echo $row["GShop_Weekly_Operation_Cost"]; ?></td>
                    </tr>
                <?php
                }
                ?>
                
            </table>
        </div>


        
        
</center>
</body>
</html>