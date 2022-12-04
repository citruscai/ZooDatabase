<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }


  if (isset($_POST['add'])){
    
    $Rid = $_POST['RestaurantID'];
    $Iname = $_POST['Restaurant_Item_Name'];
    $Rstock = $_POST['Restaurant_Remaining_Stock'];
    $price = $_POST['RItemPrice'];
    
    //need to make so primary key is unique
    $insertion = "INSERT INTO RESTAURANT_INVENTORY(RestaurantID, Restaurant_Item_Name, Restaurant_Remaining_Stock, RItemPrice) VALUES('$Rid' , '$Iname' , '$Rstock', '$price')";

    if ($conn->query($insertion)===TRUE){
        echo 'Successfully Added!';
    }
    else{
        echo 'Error :(';
    }
  }

  // DELETE FROM TABLE
  if (isset($_GET['Delete'])){

    $id = $_GET['Delete'];
    $delete = "DELETE FROM `RESTAURANT_INVENTORY` WHERE Restaurant_Item_Name='$id'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully Deleted!';
    }
    else{
        echo 'Error :(';
    }
  }

  if (isset($_POST['update'])){
    
    $Rid = $_POST['RestaurantID'];
    $Iname = $_POST['Restaurant_Item_Name'];
    $Rstock = $_POST['Restaurant_Remaining_Stock'];
    $price = $_POST['RItemPrice'];
    
    //need to make so primary key is unique
    $update = "UPDATE `RESTAURANT_INVENTORY` SET `Restaurant_Remaining_Stock`='$Rstock', RItemPrice='$price' WHERE `Restaurant_Item_Name`='$Iname' AND `RestaurantID`='$Rid'";

    if ($conn->query($update)===TRUE){
        echo 'Successfully Updated!';
    }
    else{
        echo 'Error :(';
    }
  }

  //VIEWS FROM DATABASE
$view = "SELECT * FROM `RESTAURANT_INVENTORY`";
$result = $conn->query($view);
//$conn->close();

?>

<!DOCTYPE html>
<html>
    <style>
        <?php include 'dataEntry.css'; ?>
    </style>
<body style="background-color: #97BB8D;">
<center><br><br>
    
    <h2>Restaurant Inventory</h2>
    <form  action="restaurantInventoryEF.php" method = "POST">
        <label for="RestaurantID"> Restaurant ID No. </label>
        <input type="text" id="RestaurantID" name="RestaurantID">
    
        <label for="Restaurant_Item_Name"> Item Name </label>
        <input type="text" id="Restaurant_Item_Name" name="Restaurant_Item_Name">

        <label for="Restaurant_Remaining_Stock"> Item Stock No. </label>
        <input type="text" id="Restaurant_Remaining_Stock" name="Restaurant_Remaining_Stock"><br><br>

        <label for="RItemPrice"> Price </label>
        <input type="text" id="RItemPrice" name="RItemPrice"><br><br>

        <input type = "submit" name = "add" value = "Add">
        <input type = "submit" name = "update" value = "Update"><br><br><br><br><br>
    </form>
    
    <!-- TABLE -->
    <div class="RInventory">
            <table>
                <tr>
                    <th>Restaurant ID</th>
                    <th>Restaurant Item Name</th>
                    <th>Remaining Stock</th>
                    <th>Item Price</th>
                </tr>
                <?php
                $select = mysqli_query($conn, "SELECT * FROM `RESTAURANT_INVENTORY`");
                while($row=mysqli_fetch_assoc($select))
                {
                ?>
                    <tr>
                        <td><?php echo $row["RestaurantID"]; ?></td>
                        <td><?php echo $row["Restaurant_Item_Name"]; ?></td>
                        <td><?php echo $row["Restaurant_Remaining_Stock"]; ?></td>
                        <td><?php echo $row["RItemPrice"]; ?></td>
                        <td><a href="restaurantInventoryEF.php?Delete=<?php echo $row['Restaurant_Item_Name']; ?>" onclick="return confirm('Are you sure you want to delete?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete</a></td>
                    </tr>
                <?php
                }
                ?>
                
            </table>
        </div>
</center>
</body>


</html>