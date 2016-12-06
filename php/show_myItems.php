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
$counter = 1;
$displayAllProducts = '<br>';

if ($items->num_rows > 0)
{
    while($row = $items->fetch_assoc()) {

	if($counter%3 == 1) {
		$displayAllProducts.= '<div class="row">';
	}

	$displayAllProducts.='<div class="col-md-3">
			      <div class="thumbnail">
		<!--		<a href="/w3images/nature.jpg" target="_blank"> -->
        <a onclick="javascript:showItemDetails(this)" >
    		  <img src="'.$row["image_link"].'" alt="Moustiers Sainte Marie" style="width:100%">
				  <div class="caption">
				    <p>Lorem ipsum donec id elit non mi porta gravida at eget metus.</p>
				  </div>
				</a>
			      </div>
			    </div>';



	if($counter%3 == 0) // If number is 3,6,9,etc close the row
	{
		$displayAllProducts.= "</div>";
	}

	$counter++; // increase the counter to start again

      }  // ends While loop

	if($counter%3 != 0)
	{
		$displayAllProducts.= "</div>";
	}



	$displayAllProducts .=  '</div>'; //Close container
	print $displayAllProducts;
    }

$conn->close();

?>
