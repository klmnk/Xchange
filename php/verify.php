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

$responseData  = [];

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $DBname);

// Validate the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_query = "SELECT * FROM `Users` WHERE `umbcid` = '$email'";

$users = $conn->query($user_query);


<<<<<<< HEAD
// if (!$users->num_rows > 0) 
// {
//     while($row = $users->fetch_assoc()) 
//     {	
// 		echo "this email has not been registered before.";
//     }
// } 
=======
if (!($users->num_rows > 0))
{
    $responseData['result']  = "user was not found";

}
>>>>>>> 8a53e39e9b2141248e9f1024c56c7a2929b120be

else {

	$user_password_query = "SELECT `password` FROM `Users` WHERE `umbcid` = '$email'";
	$pass = $conn->query($user_password_query);
  $current_password = '';
    while($row = $pass->fetch_assoc())
    {
      $current_password = $row['password'];
    //echo "this email has not been registered before.";
    }

	if ($current_password != $user_password )
	{
    $responseData['result']  = "password does not match";
	//	exit('<p> Error: password does not match our records.  ' . mysql_error() . '</p>');
	}
  else {

    $pieces = explode("@", $email);
    $cookie_name = $pieces[0];
    $cookie_value = randomString();
    $responseData['result']  = "success";
    $responseData['cookie_name']  = $cookie_name;
    $responseData['cookie_value']  = $cookie_value;

    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  }
}

$conn->close();
//response to a client
echo json_encode($responseData);
exit();

function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}



?>
