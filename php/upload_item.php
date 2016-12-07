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

$responseData  = [];
if(count($_POST))
{
	//print_r($_POST);
   if($_SERVER['DOCUMENT_ROOT'] == "/opt/lampp/htdocs")
   {
   	$serverpath =  '/opt/lampp/temp/';
   }
   else
   {
   	$serverpath =  '/var/www/html/users/';
   }

	$uploadFilePath = 	$serverpath  . basename($_FILES['image_file']['name']);
    if (!move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadFilePath))
    {
         echo "File upload failed!\n";
         echo 'Here is some more debugging info:';
         print_r($_FILES);
         print_r($_POST);
    }
//$new_path =  $_SERVER['DOCUMENT_ROOT'] . '/Xchange/users/klimen10/' . $_FILES['image_file']['name'];
//copy($uploadFilePath,$new_path);
	//print count($_POST) . count($_FILES);
//	print_r($_POST);
//	print_r($_FILES);
$responseData['result']  = "success";
$responseData['filePath'] = $uploadFilePath;
$responseData['server_root'] = $_SERVER['DOCUMENT_ROOT'];
}
// close the connection




$item_name = $_POST["item_name"];
$description = $_POST["description"]; 
$umbc_id = $_POST["umbc_id"] . "@umbc.edu";

$image_link = "http://dinarasagitova.com/users/" . basename($_FILES['image_file']['name']); 

$seller_query = "SELECT * FROM `Users` WHERE `umbcid`='$umbc_id'";
$seller_response = $conn->query($seller_query);
if ($seller_response->num_rows > 0) {
	while ($row = $seller_response->fetch_assoc()) {
		$seller = $row["id"];
	}
}

//print_r($seller);

$insert_query = "INSERT INTO Products (item_name, image_link, seller, description, category) VALUES ('$item_name', '$image_link', '$seller', '$description', 0)";
if ($conn->query($insert_query) === TRUE) {
	$responseData['result'] = "success";
	//echo "";
}
else {
	$responseData['result'] = $sql . ' ' .$conn->error ;
}
echo json_encode($responseData);
exit();
?>
