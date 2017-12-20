<?php

	session_start();

	require_once("connect.php");

	$user_check=$_SESSION['user'];

	$sql = mysqli_query($mysqli,"SELECT user FROM user WHERE user='$user_check' ");

	$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$login_user=$row['user'];

	if(!isset($user_check)){

		echo "
		    <meta http-equiv='refresh' content=' 0 ;url=/login.php'>";
	
	}
	
?>



