<?php
	session_start();
	$un=$_SESSION['un'];
	unset($un);
	header('Location:index.php');
	

?>
