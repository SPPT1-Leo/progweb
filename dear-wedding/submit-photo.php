<?php

	require_once("connect.php");
	require_once("check.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

	<title> Dear Wedding </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--- FAVICON -->

    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

</head>

<form method="POST" action="upload.php" enctype="multipart/form-data">
			
		<label> Title </label> <br>
		<input type="text" name="title"><br>

		<label> E-mail </label>
		<input type="text" name="email"><br>
		
		<label for="picture"> Picture </label> 
		<input type="file" name="picture"> <br>

		<label> Message </label> <br>
		<input type="text" name="msg"><br>

		<input type="submit" name="submit">

	</form>
	</form>



</body>
</html>