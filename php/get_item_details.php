<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $item_id = $_POST['item_id'];
}

//information for connecting to database
$servername = "104.236.58.254";
$username = "umbcxchange";
$password = "umbcxchange";
$DBname = "umbcxchange";

$responseData  = [];
// Create connection to the database
$conn = new mysqli($servername, $username, $password, $DBname);

// Validate the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    $responseData['result'] = 'error';
}

$items_query = "SELECT * FROM `Products` WHERE `id`='$item_id' ";

$items = $conn->query($items_query);

if (!$items)
{
    $responseData['result'] = 'error';
  //  exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($items->num_rows > 0)
{
    // print out items 3 in a row
    while($row = $items->fetch_assoc())
    {
      $responseData['result'] = 'success';
      $responseData['item_name'] =  $row["item_name"] ;
		  $responseData["seller"] = $row["seller"];
		  $responseData["condition"] = $row["condition"];
		  $responseData["manufacturer"] = $row["manufacturer"];
		  $responseData["description"] = $row["description"];
      $responseData["image_link"] = $row["image_link"];

	}
}

$conn->close();

echo json_encode($responseData);

exit();

?>
