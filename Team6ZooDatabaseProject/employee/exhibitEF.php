<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  // ADD/INSERT INTO DATABASE
  if (isset($_POST['add'])){
    
    $Exname = $_POST['Ex_Name'];
    $id = $_POST['Ex_DeptID'];
    $M_SSN = $_POST['EX_Manager_SSN'];
    $cost = $_POST['Weekly_Ex_Cost'];

    $qry1= "SELECT * FROM DEPARTMENT WHERE Dept_ID=$id";
    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result1 = mysqli_query($conn,$qry1);
    $result2 = mysqli_query($conn,$qry2);
    $num_rows1 = mysqli_num_rows($result1);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows1 > 0 && $num_rows2 > 0){
        mysqli_query($conn, "INSERT INTO EXHIBIT (Ex_Name, Ex_DeptID, Ex_Manager_SSN, Weekly_Ex_Cost) VALUES ('$Exname', $id, '$M_SSN', '$cost')");

    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: exhibitEF.php?remarks=success");
  }


  // DELETE FROM DATABSE
  if (isset($_POST['delete'])){
    
    $Exname = $_POST['Ex_Name'];

    $delete = "DELETE FROM EXHIBIT WHERE Ex_Name='$Exname'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully Deleted! :D';
    }
    else{
        echo 'Error :(';
    }
  }


  // UPDATE FROM DATABASE
  if (isset($_POST['update'])){
    
    $Exname = $_POST['Ex_Name'];
    $M_SSN = $_POST['EX_Manager_SSN'];
    $cost = $_POST['Weekly_Ex_Cost'];

    $qry2= "SELECT * FROM EMPLOYEE WHERE E_SSN='$M_SSN'";
    $result2 = mysqli_query($conn,$qry2);
    $num_rows2 = mysqli_num_rows($result2);

    if ($num_rows2 > 0){
        mysqli_query($conn, "UPDATE `EXHIBIT` SET `EX_Manager_SSN`='$M_SSN' AND `Weekly_Ex_Cost`='$cost' WHERE `Ex_Name`='$Exname'");
        echo 'Successfully Updated! :D';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: exhibitEF.php?remarks=success");
  }

  

//CREATE VIEW FOR PAGE
$view = "SELECT * FROM EXHIBIT";
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
    <h2>Exhibit</h2>
    <form action="exhibitEF.php" method="POST">
        <label for="Ex_Name"> Name of Exhibit </label>
        <input type="text" id="Ex_Name" name="Ex_Name">

        <label for="Ex_DeptID"> Department ID No. </label>
        <input type="text" id="Ex_DeptID" name="Ex_DeptID">

        <label for="EX_Manager_SSN"> Manager SSN </label>
        <input type="text" id="EX_Manager_SSN" name="EX_Manager_SSN"><br><br>

        <label for="Weekly_Ex_Cost"> Weekly Cost </label>
        <input type="text" id="Weekly_Ex_Cost" name="Weekly_Ex_Cost"><br><br>

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


        <input type = "submit" name = "update" value = "Update">  <br><br><br><br><br>
    </form>

    <div class="exhibitTable">
    <table>
        <tr>
            <th>Department ID</th>
            <th>Manager SSN</th>
            <th>Exhibit Name</th>
            <th>Weekly Cost</th>
        </tr>

        <?php
                
        while($row=$result->fetch_assoc())
        {
        ?>
            <tr>
                <td><?php echo $row["Ex_DeptID"]; ?></td>
                <td><?php echo $row["EX_Manager_SSN"]; ?></td>
                <td><?php echo $row["Ex_Name"]; ?></td>
                <td><?php echo $row["Weekly_Ex_Cost"]; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
        
</center>
</body>
</html>