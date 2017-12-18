<?php

	session_start();

	require_once("connect.php");

	$user_check=$_SESSION['user'];

	$sql = mysqli_query($mysqli,"SELECT user FROM user WHERE user='$user_check' ");

	$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$login_user=$row['user'];

	if(!isset($user_check)){

		header("Location: login.php");
	
	}else{

		$counter = time();

		if (!isset($_SESSION['count'])) {

			$_SESSION['count'] = $counter;

		}
		if ($counter - $_SESSION['count'] >= 50){

			session_unset();
			session_destroy();
			header('location:login.php');

		}

		$_SESSION['count']= $counter;

	}

?>



