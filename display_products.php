<!DOCTYPE html>
<html>

<head>
    <title>home-products</title>
</head>

<body>

<h1>products</h1>

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

$items_query = "SELECT * FROM `Items`";
$items = $conn->query($items_query);

if (!$items) 
{  
    exit('<p> Error: ' . mysql_error() . '</p>');  
}  

// due to time constraints hard-coded for the demo/testing purpose
$counter = 1;

if ($items->num_rows > 0) 
{
    // print out items 3 in a row
    while($row = $items->fetch_assoc()) 
    {	

        echo "<p style='display: inline;'>" . $row["item_name"];
        echo "<img src=" . $row["image_link"] . " alt=" . $row["item_name"] . " height='200' width='200' " . ">" . "</p>";

        if ($counter%3==0) { echo "<br>"; }
        $counter++;
    }

} 

// close the connection
$conn->close();

?>


</body>
</html>
