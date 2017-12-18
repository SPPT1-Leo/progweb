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

</head>
<body>

	<div id="menu">

		<h1> Wedding Feed </h1>
		<h2> <a href="submit-photo.php">Submit Photo </a></h2>

		<h3><a href="logout.php">Logout</a></h3>		

	</div>

	<?php
		
		echo "<div>";

			$sql = "SELECT `title`, `user`, `date`, `image`, `msg` FROM `post`";

			$result = mysqli_query($mysqli,$sql);

			while($row = mysqli_fetch_object($result)){

				echo $row['title'];
				echo "<br>";
				echo $row['title'];
				echo "<br>";
				echo $row['title'];
				echo "<br>";
				echo $row['title'];
				echo "<br>";
				echo $row['title'];
				}
	
		echo "</div>";

	?>




</body>
</html>