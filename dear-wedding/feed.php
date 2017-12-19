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
<body>

	<div id="menu">

		<h1> Wedding Feed </h1>

		<h3><a href="logout.php">Logout</a></h3>		
		<h3><a href="submit-photo.php">Upload photo</a></h3>	

	</div>

	<?php
		
		echo "<div>";

			$sql = "SELECT `title`, `msg`, `image`, `user`, `date` FROM `post`";

			$result = mysqli_query($mysqli,$sql);

			while($row = mysqli_fetch_assoc($result)){

				echo $row['title'];
				echo "<br>";
				echo $row['msg'];
				echo "<br>";
				echo " <img src='images/".$row['image']."'>";
				echo "<br>";
				echo $row['user'];
				echo "<br>";
				echo $row['date'];
				echo "<br>";

				}
	
		echo "</div>";

	?>




</body>
</html>