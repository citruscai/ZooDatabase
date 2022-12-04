<!DOCTYPE html>
<html>
<body style="background-color: #97BB8D; font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto;">
<head>
<script language="javascript">

function SelectRedirect(){
    switch (document.getElementById('Department').value){
        case "ANIMAL":
            window.location="animalEF.php";
            break;

        case "ENCLOSURE":
            window.location="enclosureEF.php";
            break;

        case "EXHIBIT":
            window.location="exhibitEF.php";
            break;

        case "GIFTSHOP":
            window.location="giftshopEF.php";
            break;
        
        case "GIFTSHOP_INVENTORY":
            window.location="giftshopInventoryEF.php";
            break;
        
        case "RESTAURANT":
            window.location="restaurantEF.php";
            break;
        
        case "RESTAURANT_INVENTORY":
            window.location="restaurantInventoryEF.php";
            break;

    }}
</script>
</head>

<center>
    <h1> Data Entry Form </h1><br><br><br><br><br>
    <label for="Department" style="font-size: 20px;"> Choose Form</label><br>
        <select id="Department" name="Department">
            <option value="ANIMAL"> Animal </option>
            <option value="ENCLOSURE"> Enclosure </option>
            <option value="EXHIBIT"> Exhibit </option>
            <option value="GIFTSHOP"> Gift Shop </option>
            <option value="GIFTSHOP_INVENTORY"> Gift Shop Inventory </option>
            <option value="RESTAURANT"> Restaurant </option>
            <option value="RESTAURANT_INVENTORY"> Restaurant Inventory </option>
            <option value="TICKET_BOOTH"> Ticket Booth </option>
        </select><br><br>
    <button onclick="SelectRedirect();"> Next</button>
</center>
</body>
</html>