<?php session_start();?>
<!DOCTYPE html>
<html lang = "en">
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel = "stylesheet" href = "index.css">
</head>



<body id = "index">


<div class = "intro" > Welcome, <strong> Employee </strong> !</div>


<div class="employee-icons container">
  <div class="card-deck">
    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/enclosure-logo.jpeg" alt="Enclosure icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="enclosureEF.php" class="btn btn-primary">Manage enclosures</a>
      </div>
    </div>

    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/exhibit-logo.jpeg" alt="Exhibit icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="exhibitEF.php" class="btn btn-primary">Manage exhibits</a>
      </div>
    </div>

    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/logo.png" alt="Animal icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="animalEF.php" class="btn btn-primary">Manage animals</a>
      </div>
    </div>

    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/giftshop-logo.jpeg" alt="Giftshop icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="giftshopEF.php" class="btn btn-primary">Manage giftshops</a>
      </div>
    </div>

    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/giftshopitem-logo.jpeg" alt="Giftshopitem icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="giftshopInventoryEF.php" class="btn btn-primary">Manage giftshop inventory</a>
      </div>
</div>

      <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/restaurant-logo.jpeg" alt="Restaurant icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="restaurantEF.php" class="btn btn-primary">Manage restaurants</a>
      </div>
</div>

      <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/food-logo.jpeg" alt="Food icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="restaurantInventoryEF.php" class="btn btn-primary">Manage restaurant inventory</a>
      </div>
   </div>

   <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/animal-logo.png" alt="Animal icon" style="width:100%" height="150px">
      <div class="card-body text-center">
      <a href="favsreport.php" class="btn btn-primary">Favorite Animal Poll Report</a>
      </div>
   </div>
  </div>
</div>

<div class = "log-out container">
<a href="../careers/index.php" class="btn btn-primary" height="100px">Log out</a>
</div>
</body>


</html>
