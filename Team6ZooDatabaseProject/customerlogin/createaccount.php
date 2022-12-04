
<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
if (isset($_POST['createaccount'])){

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["Username"];
$password = $_POST["Password"];

$query1 = "INSERT INTO USER (UserEmail, Userpassword, role) VALUES ('$email', '$password', 'customer')";

$user = mysqli_query($conn, $query1);

if ($user==TRUE){
$query2 = "INSERT INTO CUSTOMER (C_FName, C_Email, C_LName) VALUES ('$firstname', '$email', '$lastname');";
$customer = mysqli_query($conn, $query2);
if ($customer == TRUE){
    header("location:index.php");
}
}
}
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "createaccount.css">
</head>

<body id = "createaccount">

<form id = "customer-login-form" action = "createaccount.php" method = "post" >
<div id = "login-menu">Create your CougarZoo Membership Account </div>
<input type = "text" name = "firstname" class = "firstname input" placeholder = "First name" required> <br>
<input type = "text" name = "lastname" class = "lastname input" placeholder = "Last name" required> <br>
<input type = "text" name = "Username" class = "username input" placeholder = "Email" required> <br>
<input type = "password" name = "Password" class = "password input" placeholder = "Password" required>  <br>
<input type = "submit" name = "createaccount" class = "createaccount" value = "Create Account">
</form>

</body>

<!-- This allows login authentication for different roles -->

<html>