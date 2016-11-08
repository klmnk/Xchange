<!DOCTYPE html>
<html>

  <head>
    <title>user profile</title>

</head>

<body>
<div>
<h1>Profile</h1>

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
$user_query = "SELECT * FROM  `Users` WHERE  `id` = 3";
$user = $conn->query($user_query);

if (!$user) 
{  
    exit('<p> Error: ' . mysql_error() . '</p>');  
}  

if ($user->num_rows > 0) 
{
    // print out items 3 in a row
    while($row = $user->fetch_assoc()) 
    {	
		echo "<ul>" . "<pre>";
		echo "firstname:  "  . $row["firstname"] . "<br><br>";
		echo "lastname:   "  . $row["lastname"] . "<br><br>";
		echo "UMBC ID:    "  . $row["umbcid"] . "<br><br>";
		echo "user since: "  . $row["register_date"] . "<br><br>";
		echo "rating:     "  . $row["rating"] . "<br><br>";
		echo "purchased:  0 purchases on record" . "<br><br>";
		echo "sold:       0 items sold" . "<br><br>";
		echo "</ul>" . "</pre>";
    }

} 
// close the connection
$conn->close();

?>

</div>
</body>
</html>
