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


<div class = "intro" > Finances </div>


<div class="manager-icons container">
  <div class="card-deck">
    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/revenue.jpeg" alt="Finance icon" style="width:100%" height="500px">
      <div class="card-body text-center">
      <a href="revenueanalytics.php" class="btn btn-primary">Revenue</a>
      </div>
    </div>

    <div class="card bg" width= 250px>
      <img class="card-img-top" src="images/expenses.png" alt="Expenses icon" style="width:100%" height="500px">
      <div class="card-body text-center">
      <a href="expenses.php" class="btn btn-primary">Expenses</a>
      </div>
    </div>

  </div>
</div>

<div class = "log-out container">
<a href="../manager/index.php" class="btn btn-primary" height="100px">Return home</a>
</div>
</body>


</html>