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
    $query = "SELECT UserEmail, Userpassword,role FROM README_RECOVER_DATABASES2.USER WHERE UserEmail = '$un' AND Userpassword = '$pw'";
    $user = mysqli_query($conn, $query);
    //this makes sure a unique user exists
    if ($user->num_rows == 1){
            $_SESSION["useremail"] = $un; //stores useremail and role 
            $user_role = $user->fetch_assoc()["role"];
            $_SESSION["userrole"] = $user_role;
            if ($user_role == 'manager'){
               header('location:../manager/index.php');
            }
            else if ($user_role == 'employee'){
               header('location:../employee/index.php');
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
    <link rel = "stylesheet" href = "index.css">
</head>

<body>
    <div id = "about">If your considering a career with us, contact us at careers@cougarzoo.com.  </div>

<form id = "customer-login-form" action = "index.php" method = "post" >
<div class = "logo"><img src =  "../images/logo.png" alt = "logo" height = "100px" width="100px"><div>
<div id = "login-menu">Cougar Zoo Staff Login</div>
<input type = "text" name = "Username" class = "username input" placeholder = "Email" required> <br>
<input type = "password" name = "Password" class = "password input" placeholder = "Password" required>  <br>
<input type = "submit" name = "login" class = "login input" value = "login">
</form>


<div id = "home-link"><a href = "../index.php">Return home  </a></div>
</body>
<html>