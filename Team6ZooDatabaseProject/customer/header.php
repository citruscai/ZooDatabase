<header class="header">
<link rel="stylesheet" href="giftshopstyle.css?v=<?php echo time(); ?>">
   <div class="flex">

      <a href="#" class="logo">Cougar Zoo</a>

      <nav class="navbar">
         <a href = "notifs.php"> Notifications </a>
         <a href="pasttickets.php">Past Tickets </a>
         <a href="products.php">shop products</a>
         <a href="ticketpurchase.php"> Purchase Tickets </a>
         <a href="../index.php"> Log out</a>

      </nav>

      <?php
      @include 'config.php';
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>