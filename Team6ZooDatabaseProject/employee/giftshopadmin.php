<?php

$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com','admin','team6database','README_RECOVER_DATABASES2') or die('connection failed');

?>

<?php


if(isset($_POST['add_product'])){
  // $g_id = $_POST['g_id'];
   $g_name = $_POST['g_name'];
   $g_price = $_POST['g_price'];
   $g_image = $_FILES['g_image']['name'];
   $g_image_tmp_name = $_FILES['g_image']['tmp_name'];
   $g_image_folder = 'uploaded_img/'.$g_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `GIFTSHOP_INVENTORY`(GiftShop_Item_Name, GShopItemPrice, GShopimg) VALUES('$g_name', '$g_price', '$g_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($g_image_tmp_name, $g_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `GIFTSHOP_INVENTORY` WHERE GiftShopID = $delete_id ") or die('query failed');
   if($delete_query){
      $message[] = 'product has been deleted';
   }else{
      header('location:giftshopadmin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['Gname'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_g_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET GiftShop_Item_Name = '$update_p_name', GShopItemPrice = '$update_p_price', image = '$update_p_image' WHERE GiftShopID = 'update_p_id'");

   if($update_query){
      move_uploaded_file($update_g_image_tmp_name, $update_g_image_folder);
      $message[] = 'product updated succesfully';
      header('location:giftshopadmin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:giftshopadmin.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="giftshopstyle.css?v=<?php echo time(); ?>">

</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>


<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <!--<input type="text" name="g_id"placeholder="enter the product id"class="box" required>> -->
   <input type="text" name="g_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="g_price" min="0" placeholder="enter the product price" class="box" required>
<!--   <input type="file" name="g_image" accept="image/png, image/jpg, image/jpeg" class="box" > -->
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
       <!--  <th>product image</th> -->
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `GIFTSHOP_INVENTORY`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
           <!-- <td><img src="uploaded_img/<?php echo $row['GShopimg']; ?>" height="100" alt=""></td> -->
            <td><?php echo $row['GiftShop_Item_Name']; ?></td>
            <td>$<?php echo $row['GShopItemPrice']; ?></td>
            <td>
               <a href="giftshopadmin.php?delete=<?php echo $row['GiftShopID']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="giftshopadmin.php?edit=<?php echo $row['GiftShopID']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `GIFTSHOP_INVENTORY` WHERE Gid = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['GiftShopID']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['GiftShop_Item_Name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['GShopItemPrice']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>















<!-- custom js file link  -->
<script src="script.js"></script>

</body>
</html>