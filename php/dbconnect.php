<!DOCTYPE html>
<html>

  <head>
    <title>query results</title>
</head>

<body>

<h1>Query results</h1>

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

echo "<div><h3>" . "you've successfully connected to UMBC XChange database" . "</br>";
echo "DB is empty so nothing to show yet." . "</h3></div>" ;

// close the connection
$conn->close();

?>


</body>
</html>
