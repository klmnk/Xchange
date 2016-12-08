<?php
$responseData  = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//	print_r ($_POST);
	$userID 					 = $_POST['userID'] . "@umbc.edu";
  $current_password  = $_POST['current_password'];
  $new_password  	   = $_POST['$new_password'];
	$responseData['result']  = "success";
	echo json_encode($responseData);
	exit();
}
?>
