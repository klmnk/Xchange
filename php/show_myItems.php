<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$user = $_POST['user_id'];
}

//information for connecting to database
$servername = "104.236.58.254";
$username = "umbcxchange";
$password = "umbcxchange";
$DBname = "umbcxchange";


// Create connection to the database
$conn = new mysqli($servername, $username, $password, $DBname);

// Validate the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = 1; // delete when the actual user info is passed

$sold_items_query = "SELECT * FROM `Products` WHERE `seller`=$user AND `category`=1";

$sold_items = $conn->query($sold_items_query);
////

if (!$sold_items)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}
print '<h2>Items traded</h2>';
if ($sold_items->num_rows == 0) {
	print '<p> You have not traded any items yet. </p>';
}

print '<br><br><h2>Items currently listed for trading</h2>';

$items_query = "SELECT * FROM `Products` WHERE `seller`=$user";

$items = $conn->query($items_query);

if (!$items)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}

// due to time constraints hard-coded for the demo/testing purpose
$displayAllProducts = '';

if ($items->num_rows > 0)
{
    while($row = $items->fetch_assoc()) {
        $displayAllProducts.='
            <div class="row" style="margin-bottom:20px;">
            <div class="col-md-12"> 
                <div class="col-md-4">
                    <a onclick="javascript:showItemDetails(this)" >
                        <img src="'.$row["image_link"].'" alt="Moustiers Sainte Marie" style="width:100px">
                        <div class="caption">
                            <p><h4>'.$row["item_name"].'</h4></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="caption">
                        <p><h4>'.$row["description"].'</h4></p>
                        <p>Sold by '.$row["seller"].'</p>
                        <button type="button" type="submit" class="btn btn-danger" onclick="contactUser()">Delete ad</button>
                        <button type="button" type="submit" class="btn btn-success" onclick="contactUser()">Mark sold</button>
                    </div>
                </div>
            </div></div>';
      }  // ends While loop

      print $displayAllProducts;
}
$conn->close();

?>
