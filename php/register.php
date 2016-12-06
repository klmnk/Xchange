<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_password = $_POST['password'];
}
//	print_r($_POST);

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
}

$count_query = "SELECT * FROM `Users`";
$count = $conn->query($count_query);
$num_users = 0;
if (!$count)
{
	$responseData['result'] =  mysql_error();
		exit();
//    exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($count->num_rows > 0)
{
    while($row = $count->fetch_assoc())
    {
		$num_users = $num_users + 1;
    }
    $num_users = $num_users + 1;
}


$user_query = "SELECT * FROM `Users` WHERE `umbcid` = '$email'";

$users = $conn->query($user_query);

if (!$users)
{  $responseData['result'] = mysql_error();

//    exit('<p> Error: ' . mysql_error() . '</p>');
}

if ($users->num_rows > 0)
{

    while($row = $users->fetch_assoc())
    {
		   $responseData['result'] = "User already exist";
			 //echo "this email has already been registered";
    }
}


else {
	$insert_query = "INSERT INTO Users (id, umbcid, firstname, lastname, password) VALUES ('$num_users','$email', '$first_name', '$last_name', '$user_password')";
	if ($conn->query($insert_query) === TRUE) {
		$responseData['result'] = "success";
    //	echo "";
	}
	else {
		$responseData['result'] = $sql . ' ' .$conn->error ;
    //	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// close the connection
$conn->close();
//response to a client
echo json_encode($responseData);
exit();

?>
