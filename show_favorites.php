<!DOCTYPE html>
<html>

  <head>
    <title>user favorites</title>

</head>

<body>
<div>
<h1>Yiren's Wishlist</h1>

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

// temporarily hard-coded
$favorites_query = "SELECT * FROM  `Favorites` WHERE  `user_id` = 1";
$wishlist = $conn->query($favorites_query);

if (!$wishlist) 
{  
    exit('<p> Error: ' . mysql_error() . '</p>');  
}  

if ($wishlist->num_rows > 0) 
{
    // print out items 3 in a row
    while($row = $wishlist->fetch_assoc()) 
    {	

		echo "<ul>" . "<pre>";
		$id = $row['item_id'];
    	$item_query = "SELECT * FROM `Products` WHERE `id`= $id";
    	$item_name = $conn->query($item_query);
    	$item = $item_name->fetch_assoc();
    	
		echo "item:  "  . $item["item_name"] . "<br><br>";
		echo "comment:   "  . $row["description"] . "<br><br>";
		echo "</ul>" . "</pre>";
    }

} 
// close the connection
$conn->close();

?>

</div>
</body>
</html>
