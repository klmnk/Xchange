<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


print_r($_POST);

//	print_r($_POST);

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




//header("Location: http://localhost/Xchange/main.html"); /* Redirect to main page */
exit();

}

?>
