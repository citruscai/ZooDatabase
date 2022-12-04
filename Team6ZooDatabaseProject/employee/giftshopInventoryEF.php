<?php 
$conn = new mysqli('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');

if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  if (isset($_POST['add'])){
    
    $Gid = $_POST['GiftshopID'];
    $Gname = $_POST['Giftshop_Item_Name'];
    $Gstock = $_POST['Giftshop_Remaining_Stock'];
    $Gprice = $_POST['GShopItemPrice'];
    
    //need to make so primary key is unique
    $insertion = "INSERT INTO GIFTSHOP_INVENTORY(GiftshopID, Giftshop_Item_Name, Giftshop_Remaining_Stock, GShopItemPrice) VALUES('$Gid' , '$Gname' , '$Gstock', '$Gprice')";

    if ($conn->query($insertion)===TRUE){
        echo 'Successfully Added!';
    }
    else{
        echo 'Error :(';
    }
  }

  if (isset($_POST['delete'])){
    
    $Gid = $_POST['GiftshopID'];
    $Gname = $_POST['Giftshop_Item_Name'];
    
    //need to make so primary key is unique
    $delete = "DELETE FROM GIFTSHOP_INVENTORY WHERE Giftshop_Item_Name='$Gname'";

    if ($conn->query($delete)===TRUE){
        echo 'Successfully Deleted!';
    }
    else{
        echo 'Error :(';
    }
  }

  if (isset($_POST['update'])){
    
    $Gid = $_POST['GiftshopID'];
    $Gname = $_POST['Giftshop_Item_Name'];
    $Gstock = $_POST['Giftshop_Remaining_Stock'];
    $Gprice = $_POST['GShopItemPrice'];
    
    //need to make so primary key is unique
    $update = "UPDATE `GIFTSHOP_INVENTORY` SET `Giftshop_Remaining_Stock`='$Gstock', `GShopItemPrice`='$Gprice' WHERE `Giftshop_Item_Name`='$Gname'";

    if ($conn->query($update)===TRUE){
        echo 'Successfully Updated!';
    }
    else{
        echo 'Error :(';
    }
  }

  

//VIEWS FROM DATABASE
$view = "SELECT * FROM GIFTSHOP_INVENTORY";
$result = $conn->query($view);
$conn->close();

?>


<!DOCTYPE html>
<html>
    <style>
        <?php include 'dataEntry.css'; ?>
    </style>
<body style="background-color: #97BB8D;">
<center><br>
    <h2>Gift Shop Inventory</h2>
    <form action="giftshopInventoryEF.php" method="POST">
        <label for="GiftshopID"> Gift Shop ID No. </label>
        <input type="text" id="GiftshopID" name="GiftshopID">

        <label for="Giftshop_Item_Name"> Item Name </label>
        <input type="text" id="Giftshop_Item_Name" name="Giftshop_Item_Name">

        <label for="Giftshop_Remaining_Stock"> Remaining Stock </label>
        <input type="text" id="Giftshop_Remaining_Stock" name="Giftshop_Remaining_Stock"><br><br>

        <label for="GShopItemPrice"> Item Price </label>
        <input type="text" id="GShopItemPrice" name="GShopItemPrice"><br><br>

        <input type = "submit" name = "add" value = "Add">

        <input type = "submit" onclick="verifyy()" name = "delete" value = "Delete">
            <script language="javascript">
                function verifyy()
                {
                    var txt;
                    if (confirm("Are you sure you want to delete <?php echo $_POST['Giftshop_Item_Name'] ?>?" ))
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

    <!-- TABLE -->
    <div class="animalTable">
            <table>
                <tr>
                    <th>Gift Shop ID</th>
                    <th>Gift Shop Item Name</th>
                    <th>Remaining Stock</th>
                    <th>Item Price</th>
                </tr>
                <?php
                
                while($row=$result->fetch_assoc())
                {
                ?>
                    <tr>
                        <td><?php echo $row["GiftShopID"]; ?></td>
                        <td><?php echo $row["GiftShop_Item_Name"]; ?></td>
                        <td><?php echo $row["GiftShop_Remaining_Stock"]; ?></td>
                        <td><?php echo $row["GShopItemPrice"]; ?></td>
                    </tr>
                <?php
                }
                ?>
                
            </table>
        </div>
        
</center>
</body>
</html>