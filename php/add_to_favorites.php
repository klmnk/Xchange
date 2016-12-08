<?php
$responseData  = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//	print_r ($_POST);
	$userID  = $_POST['user_id'] . "@umbc.edu";
  $itemID  = 	$_POST['item_id'];

	$responseData['result']  = "success";
	$responseData['user_id']  = $userID;
	$responseData['item_id']  = $itemID;
	echo json_encode($responseData);
	exit();
}
?>
