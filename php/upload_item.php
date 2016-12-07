<?php

$responseData  = [];
if(count($_POST))
{
	$uploadFilePath = '/opt/lampp/temp/' . basename($_FILES['image_file']['name']);
    if (!move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadFilePath))
    {
         echo "File upload failed!\n";
         echo 'Here is some more debugging info:';
         print_r($_FILES);
         print_r($_POST);
    }
$new_path =  $_SERVER['DOCUMENT_ROOT'] . '/Xchange/users/klimen10/' . $_FILES['image_file']['name'];
copy($uploadFilePath,$new_path);
	//print count($_POST) . count($_FILES);
//	print_r($_POST);
//	print_r($_FILES);
$responseData['result']  = "success";
$responseData['filePath'] = $uploadFilePath;
$responseData['server_root'] = $_SERVER['DOCUMENT_ROOT'];
}
// close the connection

echo json_encode($responseData);
exit();


?>
