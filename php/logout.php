<?php

if(count($_GET))
{
	$user = $_GET['username'];
  setcookie($user, "", time() - 3600);
	header("Location: ../index.html"); /* Redirect browser */
}
// close the connection

exit();

?>
