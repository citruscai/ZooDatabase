<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  // INSERT FUNCTION
  if (isset($_POST['add'])){
    
    $Exname = $_POST['Ex_Name'];
    $habitat = $_POST['Habitat'];

    $qry="SELECT * FROM EXHIBIT WHERE Ex_Name='$Exname'";
    $result = mysqli_query($conn,$qry);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0){
        mysqli_query($conn, "INSERT INTO ENCLOSURE (Ex_Name, Habitat) VALUES ('$Exname', '$habitat')");
        echo 'Successfully Updated!';
    }
    else{
        mysqli_error($conn);
        echo 'Error :(';
        }
    mysqli_close($conn);
    header ("location: enclosureEF.php?remarks=success");
  }

  // DELETE FUNCTION
  if (isset($_POST['delete'])){
    
    $Exname = $_POST['Ex_Name'];
    $habitat = $_POST['Habitat'];
    $id = $_POST['Encl_ID'];

    $delete = "DELETE FROM ENCLOSURE WHERE Encl_ID='$id'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully deleted! :D';
    }
    else{
        echo 'Error :(';
    }
  }
  



//CREATE VIEW FOR PAGE
$view = "SELECT * FROM ENCLOSURE";
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
    <h2>Enclosure</h2>
    <form  action="enclosureEF.php" method = "POST">
        <label for="Encl_ID"> ID No. </label>
        <input type="text" id="Encl_ID" name="Encl_ID">

        <label for="Ex_Name"> Exhibit </label>
        <input type="text" id="Ex_Name" name="Ex_Name">

        <label for="Habitat"> Habitat for </label>
        <input type="text" id="Habitat" name="Habitat"><br><br>

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
      <br><br><br><br>
    </form>

<div class="enslosureTable">
    <table>
        <tr>
            <th>Enclosure ID</th>
            <th>Exhibit Name</th>
            <th>Habitat</th>
        </tr>

        <?php
                
        while($row=$result->fetch_assoc())
        {
        ?>
            <tr>
                <td><?php echo $row["Encl_ID"]; ?></td>
                <td><?php echo $row["Ex_Name"]; ?></td>
                <td><?php echo $row["Habitat"]; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

</center>
</body>
</html>