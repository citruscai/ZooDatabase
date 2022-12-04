<!DOCTYPE html>
<html>
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <!-- Adds bootstrap-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="navbar.css">
</head>

<body id = "index">

<nav class="navbar cougarzoonav navbar-light navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand nav-text-options" href="index.php"><span><img class = "logo" src = "images/logo.png" alt = "logo" width="50px" height = "50px"></span> <span>Cougar Zoo</span></a>
    </div>
    <ul class="nav navbar-nav">
      <li class = "active"><a class = "nav-text-options" href = "customerlogin/index.php">Member Sign in</a></li>
    </ul>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <center>
  <div class="carousel-inner">

  <div class="item active">
      <img class="d-block w-100 carousel-image" src="images/cougarzoo.jpeg" alt="Cougar Zoo">
      <div class="carousel-caption d-none d-md-block">
    <p id = "purchase-1" >Plan your zoo visit</p>
    <p><button id = "purchase-2"> <a id= "purchase-2-text" href="customerlogin/index.php">Purchase tickets </a> </button> </p>
  </div>
    </div>

    <div class="item">
      <img class="d-block w-100 carousel-image" src="images/employees.jpeg" alt="Employees">
      <div class="carousel-caption d-none d-md-block">
    <p id = "employee-1">Considering a career with us?</p>
    <p id = "employee-2"><a href="careers/index.php"> Learn more </a> </p>
  </div>
    </div>

    <div class="item">
      <img class="d-block w-100 carousel-image" src="images/shastavi.jpeg" alt="Shasta VI">
      <div class="carousel-caption d-none d-md-block">
    <p id = "shastavi">Commemorating Shasta VI</p>
  </div>
    </div>

    <div class="item">
      <img class="d-block w-100 carousel-image" src="images/shastavii.jpeg" alt="Shasta VII">
      <div class="carousel-caption d-none d-md-block">
      <p id = "shastavii-1">Whose House?</p>
      <p id = "shastavii-2">Coogs House </p>
      <p id = "shastavii-3">Introducing Shasta VII and Louie.</p>
</div>
    </div>

  </div>
</center>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class = "footer">
<span id = "termsofservice"><a href = ""> Terms of Service </a> </span>
&nbsp&nbsp&nbsp
<span id = "careers"> <a href = "careers/index.php"> Careers </a>  </span>
</div>


</body>

<html>
