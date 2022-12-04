<?php if(session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    else
    {
      session_destroy();
      session_start();
    } ?>
<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  if (isset($_POST['login'])){
    $un = $_POST['Username'];
    $pw = $_POST['Password'];
    $query = "SELECT UserEmail, Userpassword,role FROM USER WHERE UserEmail = '$un' AND Userpassword = '$pw' AND role = 'customer'";
    $user = mysqli_query($conn, $query);
    //this makes sure a unique user exists
    if ($user->num_rows == 1){
            $user_role = $user->fetch_assoc()["role"];
            if ($user_role == 'customer'){
              $customerquery = "SELECT `C_FName`, `C_LName`, `C_Email` FROM `CUSTOMER` WHERE `C_Email` = '$un'";
              $customer = mysqli_query($conn, $customerquery);
              $row = mysqli_fetch_assoc($customer);
              $_SESSION["firstName"] = $row['C_FName'];
              $_SESSION["lastName"] = $row['C_LName'];
              $_SESSION["email"] = $row['C_Email'];
              header('location:../customer/ticketpurchase.php');
            }
            exit();
    }
    else{
        echo 'Invalid username or password';
    }
  }

?>

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

<span>
<form id = "customer-login-form" action = "index.php" method = "post" >
<div class = "logo"><img src =  "../images/logo.png" alt = "logo" height = "100px" width="100px"><div>
<div id = "login-menu">Welcome to the Cougar Zoo Membership Portal </div>
<input type = "text" name = "Username" class = "username" placeholder = "Email" required> <br>
<input type = "password" name = "Password" class = "password" placeholder = "Password" required>  <br>
<input type = "submit" name = "login" class = "login" value = "login">
 <div id = "create-account" style="margin-top:5%"><a href = "createaccount.php" id = "create-account-link">Don't have an Account?</a></div>
 <div id = "careers"  style="margin-top:5%">  If your logging in as a manager or employee, visit our <a href = "../careers/index.php">careers </a> page.</div>
</form>
</span>

<span class = "about">
<div class = "m1"> Membership benefits <div>
<li> Reserve Tickets Online </li>
<li> Preorder Giftshop Items for pickup  </li>
<li> Catalog our animals,restaurants, and more </li>
<span>

</body>

<!-- This allows login authentication for different roles -->


<html>