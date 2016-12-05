<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
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

$items_query = "SELECT * FROM `Products` WHERE `item_name`=$item_id ";

$items = $conn->query($items_query);

if (!$items)
{
    exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($items->num_rows > 0)
{
    // print out items 3 in a row
    while($row = $items->fetch_assoc())
    {	
    	$item_name = $row["item_name"] ;
		$seller = $row["seller"] ;
		$condition =  $row["condition"];
		$manufacturer = $row["manufacturer"];
		$description = $row["description"];
	}
}

$conn->close();

?>
