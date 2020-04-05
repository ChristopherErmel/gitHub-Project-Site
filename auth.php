<?php

//this is used to make sure the user is logged in with a session, if not they will be sent back to the login page.

session_start();
if (empty($_SESSION['user_id'])){
	header('location:myid.php');
	exit();

}


?>