<?php
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

$items_query = "SELECT * FROM `Products` ORDER BY category";

$items = $conn->query($items_query);

if (!$items)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}

$counter = 1;
$displayAllProducts = '<div class="container">
			<div class="row">
			<div class="col-md-8"><h2>View all items available for barter</h2></div><br>
			</div>';

if ($items->num_rows > 0)
{
    // print out items 3 in a row
    while($row = $items->fetch_assoc()) {

	if($counter%3 == 1) {  // If number is 1,4,7,etc start a new row
	
		// show category as its own row before each new row
		$displayAllProducts.= '<div class="row">';
	}

	$displayAllProducts.='<div class="col-md-3">
			    <div class="thumbnail">
        			<a id = "'. $row["id"].'"onclick="javascript:showItemDetails(this.id)" >
    		  			<img src="'.$row["image_link"].'" alt="Moustiers Sainte Marie" style="width:100%">
						<div class="caption">
							<p><h4>'.$row["item_name"].'</h4></p>
				  		</div>
					</a>
			    </div></div>';

	if($counter%3 == 0) { // If number is 3,6,9,etc close the row
	
		$displayAllProducts.= "</div>";
	}

	$counter++; // increase the counter to start again

    }  // ends While loop

	if($counter%3 != 0) {

		$displayAllProducts.= "</div>";
	}

	$displayAllProducts .=  '</div>'; //Close container
	print $displayAllProducts;
}

$conn->close();

?>
