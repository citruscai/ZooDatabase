<?php 
$conn = new mysqli('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }


  if (isset($_POST['add'])){
    
    $name = $_POST['Animal_Name'];
    $species = $_POST['Species'];
    $age = $_POST['Animal_Age'];
    $gender = $_POST['Animal_Sex'];
    $diet = $_POST['Diet'];
    
    // ADD INTO TABLE
    $insertion = "INSERT INTO ANIMAL(Animal_Name,Species,Animal_Age,Animal_Sex,Diet) VALUES('$name' , '$species' , '$age', '$gender', '$diet')";

    if ($conn->query($insertion)===TRUE){
        echo 'Successfully added! :D';
    }
    else{
        echo 'Error :(';
    }
  }

  if (isset($_POST['delete'])){
    
    $name = $_POST['Animal_Name'];
    $Aid = $_POST['Animal_ID'];
    
    //delete by animal name ONLY
    $delete = "DELETE FROM ANIMAL WHERE Animal_Name='$name' OR Animal_ID='$Aid'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully deleted! :D';
    }
    else{
        echo 'Error :(';
    }
  }

  if (isset($_POST['update'])){
    
    $Aid = $_POST['Animal_ID'];
    $name = $_POST['Animal_Name'];
    $diet = $_POST['Diet'];
    
    //need to make so primary key is unique
    $update = "UPDATE `ANIMAL` SET `Diet`='$diet' WHERE `Animal_ID`='$Aid'";

    if ($conn->query($update)===TRUE){
        echo 'Successfully Updated!';
    }
    else{
        echo 'Error :(';
    }
  }

//VIEWS FROM DATABASE
$view = "SELECT * FROM ANIMAL";
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

    <center>
        <br>
        <h2>Animals</h2><br>
    <form  action="animalEF.php" method = "POST">
            <label for="Animal_ID"> ID No. </label>
            <input type="text" id="Animal_ID" name="Animal_ID">
            
            <label for="Animal_Name"> Name </label>
            <input type="text" id="Animal_Name" name="Animal_Name">

            <label for="Animal_Sex"> Animal gender </label>
            <select id="Animal_Sex" name="Animal_Sex">
            <option value = "M"> M </option>
            <option value = "F"> F </option>
            </select>

            <label for="Animal_Age"> Animal Age </label>
            <input type="text" id="Animal_Age" name="Animal_Age"><br><br>

            <label for="Species"> Species </label>
            <input type="text" id="Species" name="Species">

            <label for="Diet"> Particular diet </label>
            <input type="text" id="Diet" name="Diet"><br><br>
            <input type = "submit" name = "add" value = "Add">

            <input type = "submit" onclick="verify()" name = "delete" value = "Delete">
            <script language="javascript">
                function verify()
                {
                    var txt;
                    if (confirm("Are you sure you want to delete <?php echo $_POST['Animal_Name'] ?>?" ))
                    {
                        txt = "Suceessfully Deleted! :D";
                    }
                    else{
                        txt = "Canceled";
                    }
                }
            </script>
            <input type = "submit" name = "update" value = "Update">  <br><br><br><br><br>
<!-- VIEWS -->
        <div class="animalTable">
            <table>
                <tr>
                    <th>Animal ID</th>
                    <th>Animal Name</th>
                    <th>Species</th>
                    <th>Animal Age</th>
                    <th>Sex</th>
                    <th>Diet</th>
                </tr>
                <?php
                
                while($row=$result->fetch_assoc())
                {
                ?>
                    <tr>
                        <td><?php echo $row["Animal_ID"]; ?></td>
                        <td><?php echo $row["Animal_Name"]; ?></td>
                        <td><?php echo $row["Species"]; ?></td>
                        <td><?php echo $row["Animal_Age"]; ?></td>
                        <td><?php echo $row["Animal_Sex"]; ?></td>
                        <td><?php echo $row["Diet"]; ?></td>
                    </tr>
                <?php
                }
                ?>
                
            </table>
        </div>

    </form>
    </center>


</body>

