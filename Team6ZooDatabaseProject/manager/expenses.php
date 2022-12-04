<?php
$conn = mysqli_connect('team6awsdb.cethcqcyjpsc.us-east-1.rds.amazonaws.com', 'admin', 'team6database', 'README_RECOVER_DATABASES2');
if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel = "stylesheet" href = "revenueanalytics.css">
<body>

<header> Weekly Expenses </header>


<center>



<canvas id="expensesBarGraph" style="width:100%;max-width:600px"></canvas>


<script>
<?php


$query = "SELECT SUM(WeeklySalary) as Total FROM EMPLOYEE";

$employeesalaries = $conn->query($query)->fetch_assoc()["Total"];

$query = "SELECT SUM(GShop_Weekly_Operation_Cost) as Total FROM GIFTSHOP";

$gcosts = $conn->query($query)->fetch_assoc()["Total"];

$query = "SELECT SUM(R_WeeklyOperationCost) as Total FROM RESTAURANT";

$rcosts = $conn->query($query)->fetch_assoc()["Total"];

$query = "SELECT SUM(Ticket_Weekly_Operation_Cost) as Total FROM TICKETBOOTH";

$tcosts = $conn->query($query)->fetch_assoc()["Total"];

$query = "SELECT SUM(Weekly_Ex_Cost) as Total FROM EXHIBIT";

$ecosts = $conn->query($query)->fetch_assoc()["Total"];


echo "
var xValues = ['Employee Salaries','Giftshop Operation Costs', 'Restaurant Operation Costs', 'Ticket Booth Operation Costs', 'Exhibit Operation Costs'];
var yValues = [$employeesalaries, $gcosts, $rcosts, $tcosts,$ecosts ];
var barColors = ['red', 'green','blue','orange','brown'];

new Chart('expensesBarGraph', {
  type: 'bar',
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: 'Total weekly expenses ($)'
    }
  }
})";

?>
</script>


<canvas id="revenue-piegraph" style="width:100%;max-width:400px"></canvas>


<script>
<?php
echo 
"
var xValues = ['Employee Salaries','Giftshop Operation Costs', 'Restaurant Operation Costs', 'Ticket Booth Operation Costs', 'Exhibit Operation Costs'];
var yValues = [$employeesalaries, $gcosts, $rcosts, $tcosts,$ecosts ];
var barColors = ['red', 'green','blue','orange','brown'];

new Chart('revenue-piegraph', {
  type: 'pie',
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: '% Share of Expenses'
    }
  }
});
";
?>
</script>

<?php
$totalexpenses = $employeesalaries +  $gcosts + $rcosts + $tcosts + $ecosts;

echo "<div class = 'revenue'>Total Weekly Operation Costs: $".$totalexpenses."</div>";
?>


</center>

</body>
</html>



