<?php

	require_once("connect.php");

	$user = $_POST['user'];
	$passwd = $_POST['passwd'];


	if(isset($_POST["go"])){

		if(empty($_POST["user"]) || empty($_POST["passwd"])){

			$error = "Both fields are required.";
			header('location:login.php');

		}else{

		$user = stripslashes($user);
		$passwd = stripcslashes($passwd);

		$user = mysqli_real_escape_string($mysqli, $user);
		$passwd = mysqli_real_escape_string($mysqli, $passwd);

		$sql = "SELECT `idUser` FROM `user` WHERE `user` = '$user' and `password` = '$passwd'";

		$result=mysqli_query($mysqli,$sql);

		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		if (mysqli_num_rows($result) == 1){
			session_start();
			$_SESSION['user'] = $user;
			$_SESSION['passwd'] = $passwd;
			$_SESSION['idUser'] = $row['idUser'];
			//$_SESSION['name'] = $row['name'];
			//$_SESSION['last'] = $row['last'];
			echo "
		    <meta http-equiv='refresh' content=' 0 ;url=/feed.php'>";

		}else{

			$error = "Incorrect name and/or password.";

			session_destroy();
			
			echo "
		    <meta http-equiv='refresh' content=' 0 ;url=/login.php'>";

		}
	}
}


?>
