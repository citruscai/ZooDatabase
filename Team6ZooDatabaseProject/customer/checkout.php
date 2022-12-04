<?php

@include 'config.php';
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:products.php');
}


if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   
   $email = $_POST['email'];
   $method = $_POST['method'];
   $product_name = $_POST['product_name'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
        // $product_name[] = $product_item['GName'] .' )';
        $product_name[] = $product_item['GName'] .'';
         $product_price = number_format($product_item['GPrice'] * $product_item['quantity']);
         $price_total += $product_price;

      };
   };

  $product_total = implode(', ',$product_name);
 //  $detail_query = mysqli_query($conn, "INSERT INTO `giftcheckout`(GName, CusEmail,paymethod,itemtotal, pricetotal) VALUES('$product_item[GName]','$email','$method','$product_total','$price_total ')");
 $detail_query = mysqli_query($conn, "INSERT INTO `SELLS_GIFTSHOP_ITEM`(C_Email,GShop_Item_Name, GPrice) VALUES('$email','$product_total','$price_total ')");

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            
            <p> your email : <span>".$email."</span> </p>
            
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>*
         </div>
            <a href='checkout.php?delete_all' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="giftshopstyle.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['GPrice'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['GName']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
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

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>