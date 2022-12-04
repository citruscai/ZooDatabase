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
<link rel = "stylesheet" href = "revenueanalytics.css">
<body>

<header> Revenue distribution by month </header>


<center>
<form method = "POST" action = "revenueanalytics.php">
<div >Select month:  </div>
<select id="data_1" name="date" style="max-width : 600px;" class="form-control">
      <option> 2022-12 </option>
      <option> 2022-11 </option>
      <option> 2022-10 </option>
      <option> 2022-09 </option>
      <option> 2022-08 </option>
      <option> 2022-07 </option>
      <option> 2022-06 </option>
      <option> 2022-05 </option>
      <option> 2022-04 </option>
      <option> 2022-03 </option>
      <option> 2022-02 </option>
      <option> 2022-01 </option>
    </select>
    </div>
<div style="padding-bottom: 18px;">
<input value="Submit" name = "generatedata" type="submit"/></div>
</form>


<canvas id="revenueBarGraph" style="width:100%;max-width:600px"></canvas>

<script>
<?php
$date = '2022-12';


$restaurantquery = "SELECT SUM(col) AS Total
FROM (SELECT (COUNT(RestSalePK) * RItemPrice) 
AS col FROM SELLS_REST_ITEM, RESTAURANT_INVENTORY
WHERE WhenRItemSold LIKE '$date%' 
AND R_Item_Name = Restaurant_Item_Name
GROUP BY R_Item_Name)
AS Tab";

$restaurantrevenue = $conn->query($restaurantquery)->fetch_assoc()["Total"];

$giftshopquery = "SELECT SUM(col) AS Total
FROM (SELECT (COUNT(GShopSellPK) * GShopItemPrice)
 AS col FROM SELLS_GIFTSHOP_ITEM, GIFTSHOP_INVENTORY 
 WHERE WhenGItemSold LIKE '$date%'
 AND GShop_Item_Name = GiftShop_Item_Name 
 GROUP BY GShop_Item_Name) AS Tab
";

$giftshoprevenue = $conn->query($giftshopquery)->fetch_assoc()["Total"];


$ticketquery = "SELECT SUM(Price) AS Total
 FROM SELLS_TICKET
 WHERE Ticket_Date LIKE '$date%'";
$ticketrevenue= $conn->query($ticketquery)->fetch_assoc()["Total"];

echo "
var xValues = ['Restaurants','Giftshops', 'Tickets'];
var yValues = [$restaurantrevenue, $giftshoprevenue, $ticketrevenue];
var barColors = ['red', 'green','blue','orange','brown'];

new Chart('revenueBarGraph', {
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
      text: 'Total revenue($) for $date'
    }
  }
})";
?>
</script>


<script>
<?php
if (isset($_POST["generatedata"])){
$date = $_POST["date"];


$restaurantquery = "SELECT SUM(col) AS Total
FROM (SELECT (COUNT(RestSalePK) * RItemPrice) 
AS col FROM SELLS_REST_ITEM, RESTAURANT_INVENTORY
WHERE WhenRItemSold LIKE '$date%' 
AND R_Item_Name = Restaurant_Item_Name
GROUP BY R_Item_Name)
AS Tab";

$restaurantrevenue = $conn->query($restaurantquery)->fetch_assoc()["Total"];

$giftshopquery = "SELECT SUM(col) AS Total
FROM (SELECT (COUNT(GShopSellPK) * GShopItemPrice)
 AS col FROM SELLS_GIFTSHOP_ITEM, GIFTSHOP_INVENTORY 
 WHERE WhenGItemSold LIKE '$date%'
 AND GShop_Item_Name = GiftShop_Item_Name 
 GROUP BY GShop_Item_Name) AS Tab
";

$giftshoprevenue = $conn->query($giftshopquery)->fetch_assoc()["Total"];


$ticketquery = "SELECT SUM(Price) AS Total
 FROM SELLS_TICKET
 WHERE Ticket_Date LIKE '$date%'";
$ticketrevenue= $conn->query($ticketquery)->fetch_assoc()["Total"];

echo "
var xValues = ['Restaurants','Giftshops', 'Tickets'];
var yValues = [$restaurantrevenue, $giftshoprevenue, $ticketrevenue];
var barColors = ['red', 'green','blue','orange','brown'];

new Chart('revenueBarGraph', {
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
      text: 'Total revenue($) for $date'
    }
  }
})";

}
?>
</script>


<canvas id="revenue-piegraph" style="width:100%;max-width:400px"></canvas>


<script>
<?php
echo 
"
var xValues = ['Restaurants','Giftshops', 'Tickets'];
var yValues = [$restaurantrevenue, $giftshoprevenue, $ticketrevenue];
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
      text: '% Share of Revenue for $date'
    }
  }
});
";
?>
</script>

<?php
$totalrevenue = $restaurantrevenue + $giftshoprevenue + $ticketrevenue;

echo "<div class = 'revenue'>Total Revenue: $".$totalrevenue."</div>";
?>


<canvas id="revenue-linegraph" style="width:100%;max-width:400px"></canvas>


<?php

$query = "SELECT DISTINCT WhenRItemSold FROM SELLS_REST_ITEM";

$query = "SELECT DISTINCT WhenGItemSold FROM SELLS_GIFTSHOP_ITEM";

$query = "SELECT DISTINCT WhenTicketSold FROM SELLS_TICKET";

?>





</center>

</body>
</html>



