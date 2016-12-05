<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//	print_r($_POST);
	//header("Location: http://localhost/Xchange/main.html"); /* Redirect to main page */
	$email = $_POST['email'];
	$user_password = $_POST['password'];


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

$user_query = "SELECT * FROM `Users` WHERE `umbcid` = '$email'";

$users = $conn->query($user_query);

if (!$users) 
{  
    exit('<p> Error: this email was not found.  ' . mysql_error() . '</p>');  
}  

// if (!$users->num_rows > 0) 
// {
//     while($row = $users->fetch_assoc()) 
//     {	
// 		echo "this email has not been registered before.";
//     }
// } 

else {

	$user_password_query = "SELECT `password` FROM `Users` WHERE `umbcid` = '$email'";
	$pass = $conn->query($user_password_query);

	if ($pass != $user_password )
	{
		exit('<p> Error: password does not match our records.  ' . mysql_error() . '</p>');
	}
}

?>
