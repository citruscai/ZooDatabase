<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
?>


<!DOCTYPE html>
<html lang = "en">
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel = "stylesheet" href = "manageemployees.css">
</head>
    <header id = "header">Manage your employees </header>
<?php
 $query = "SELECT E_SSN,E_FName,E_LName, E_Sex,E_Phone, E_Email, Dept_Name, WeeklySalary FROM EMPLOYEE,DEPARTMENT WHERE EMPLOYEE.E_DeptID =  DEPARTMENT.Dept_ID";

 $employees = $conn->query($query);
  

 if ($employees->num_rows > 0){
    echo "<center><table class = 'table table-striped'>";
    echo "<thead><tr><th>SSN</th><th>First Name</th><th> Last Name</th> <th> Gender </th> <th>Email  </th> <th>Phone Number </th> <th>Department </th> <th>Weekly Salary</th> <tr></thead>";
    echo "<tbody>";
    while ($row = $employees->fetch_assoc()){
        echo "<tr class = 'info'><td>".$row["E_SSN"]."</td><td>".$row["E_FName"]."</td><td>".$row["E_LName"]."</td><td>".$row["E_Sex"]."</td><td>".$row["E_Email"]."</td><td>".$row["E_Phone"]."</td><td>".$row["Dept_Name"]."</td><td>$".$row["WeeklySalary"]."</tr></td>";
    }
    echo "</tbody>";
    echo "</table></center>";
 }
?>

<form id = "update-employee-salary-form" method = "POST" action = "manageemployees.php">
<div id = "update-employee-salary-title"> Update Employee Salary   </div>
<div><input type = "text" name = "SSN" placeholder = "SSN"></div>
<div><input type = "text" name = "new_salary" placeholder = "New Salary"></div>
<div><input  class = "button" type = "submit" name = "updatesalary" value = "Update Salary"></div>
</form>

<?php
if (isset($_POST["updatesalary"])){
  $ssn = $_POST["SSN"];
  $new_salary = $_POST["new_salary"];

  $query = "UPDATE EMPLOYEE SET WEEKLYSALARY = '$new_salary' WHERE E_SSN = '$ssn'";
  $conn->query($query);
  header("location:manageemployees.php");
}

?>

<form id = "update-employee-department-form" method = "POST" action = "manageemployees.php">
<div id = "update-employee-department-title"> Update Employee Department  </div>
<input type = "text" name = "SSN" placeholder = "SSN">
<center>
  Department:
<select id="data_1" name="department" class="form-control">
    <option>North</option>
    <option>South</option>
    <option>East</option>
    <option>West</option>
    <option>Fifth</option>
</select>
</center>
<input class = "button" type = "submit" name = "updatedepartment" value = "Update Department">
</form>

<?php
  if (isset($_POST["updatedepartment"])){
     $ssn = $_POST["SSN"];
     $department = $_POST["department"];

    if ($department == "North"){
     $query = "UPDATE EMPLOYEE SET E_DEPTID = '1' WHERE E_SSN = '$ssn'";
     }
    else if ($department == "South"){
      $query = "UPDATE EMPLOYEE SET E_DEPTID = '2' WHERE E_SSN = '$ssn'";
      }
    else if ($department == "East"){
        $query = "UPDATE EMPLOYEE SET E_DEPTID = '3' WHERE E_SSN = '$ssn'";
      }
    else if ($department == "West"){
          $query = "UPDATE EMPLOYEE SET E_DEPTID = '4' WHERE E_SSN = '$ssn'";
       }
    else if ($department == "Fifth"){
          $query = "UPDATE EMPLOYEE SET E_DEPTID = '5' WHERE E_SSN = '$ssn'";
      }
     $conn->query($query);
     header("location:manageemployees.php");
  }
?>

<form id = "delete-employee-form" method = "POST" action = "manageemployees.php">
<div id = "delete-employee-form-title" > Remove an employee </div>
  <input type = "text" name = "SSN" placeholder = "SSN">
<div> <input class = "button" type = "submit" onclick = "verify()" name = "delete"  value = "Remove Employee" ></div> 
<script>
                function verify()
                {
                    var txt;
                    if (confirm("Are you sure you want to delete this employee?" ))
                    {
                        txt = "Successfully Deleted! :D";
                    }
                    else{
                        txt = "Canceled";
                    }
                }
</script>

</form>

<?php
if (isset($_POST["delete"])){
   $ssn = $_POST["SSN"];
   $query = "DELETE FROM EMPLOYEE WHERE EMPLOYEE.E_SSN = '$ssn' ";

   if ($conn->query($query) ==TRUE){
   //need to delete from user table
   header("location:manageemployees.php");
   }
}
?>

<form id = "add-employee-form" method = "POST" action = "manageemployees.php">
<div id = "add-employee-form-title"> Add an employee </div>
<div><input type = "text" name = "SSN" placeholder = "SSN"></div>
<div><input type = "text" name = "firstname" placeholder = "First Name"></div>
<div><input type = "text" name = "lastname" placeholder = "Last Name"></div>
<div><input type = "text" name = "age" placeholder = "Age"></div>
<div><input type = "text" name = "phone" placeholder = "Phone Number"></div>
<div><input type = "text" name = "address" placeholder = "Address"></div>
<div><input type = "text" name = "weeklysalary" placeholder = "Weekly Salary"></div>
<div>
<center>
  Gender:
<select id="data_1" name="sex" class="form-control">
    <option>M</option>
    <option>F</option>
</select>
</center>
</div>
<div>
  <center>
  Department:
<select id="data_1" name="Department" class="form-control">
    <option>North</option>
    <option>South</option>
    <option>East</option>
    <option>West</option>
    <option>Fifth</option>
</select>
</center>
</div>
<div><input type = "text" name = "email" placeholder = "Email"></div>
<input class = "button" type = "submit" name = "add_employee" value = "Add Employee">
</form>

<?php

if (isset($_POST["add_employee"])){
$ssn = $_POST["SSN"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$age = $_POST["age"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$weeklysalary = $_POST["weeklysalary"];
$sex = $_POST["sex"];
$department = $_POST["Department"];
$department_id;
if ($department == "North"){
  $department_id = '1';
  }
else if ($department == "South"){
  $department_id = '2';
   }
else if ($department == "East"){
  $department_id = '3';
   }
else if ($department == "West"){
  $department_id = '4';
    }
else if ($department == "Fifth"){
  $department_id = '5';
   }
$email = $_POST["email"];


//generates random password
function generateRandomString($length = 10) {
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$password = generateRandomString();

$query = "INSERT INTO USER (UserEmail, Userpassword, role) 
VALUES ('$email', '$password','employee' )";

if ($conn->query($query) == TRUE){
$query = "INSERT INTO EMPLOYEE (E_SSN,E_FName, E_LName, E_Age, E_Phone, E_Address, WeeklySalary, E_Sex,E_DeptID, E_Email) 
VALUES('$ssn','$firstname', '$lastname', '$age', '$phone', '$address', '$weeklysalary','$sex' , '$department_id', '$email')";
if ($conn->query($query) == TRUE){
  header("location:manageemployees.php");
}
}

}

?>

<center>
<div class = "log-out container">
<a href="../manager/index.php" class="btn btn-primary" height="100px">Return home</a>
</div>
</center>

</html>
