<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$email = $_POST['email'];
}
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

$user_query = "SELECT * FROM `Users` WHERE `umbcid` = '$email'";

$users = $conn->query($user_query);

if (!$users) 
{  
    exit('<p> Error: ' . mysql_error() . '</p>');  
}  

if ($users->num_rows > 0) 
{
    // print out items 3 in a row
    while($row = $users->fetch_assoc()) 
    {	
		echo "this user already exists";
    }

} 

// close the connection
$conn->close();


?>
