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

    <!--- CSS -->

    <link rel="stylesheet" href="css/navbar.css">
    
    <link rel="stylesheet" href="css/feed.css">


    <!--- GOOGLE FONTS-->

	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

</head>
<body>

<div id="menu">


	<nav class = "navbar">
	

			<ul>
				
				<li class="now"> <a href="feed.php"> Wedding Feed </a></li>

				<li class="others"> <a href="submit-photo.php"> Upload photo</a></li>	
			
				<li class="logout"> <a href="logout.php"> Logout </a></li>	
			</ul>

		</div>
		
	</nav>


	<?php
		
		echo "<div>";

			$sql = "SELECT `title`, `msg`, `image`, `user`, `date` FROM `post` ORDER BY  `idPost` desc";
			

			$result = mysqli_query($mysqli,$sql);

			while($row = mysqli_fetch_assoc($result)){

                $sql2 = "SELECT `user`, `name`, `last` FROM `user` WHERE `idUser` =".$row['user'];
                $result2 = mysqli_query($mysqli,$sql2);
                echo "<div style='background-color: white; color: #8B864E; position: relative; background-color: white; margin-left: 300px; margin-right: 300px; padding: 5px; border-radius: 5px; margin-top: -16px;'> ";
				echo "<center> <h2 style='font-size: 27px; font-family:Pacifico, cursive; text-shadow: 0.5px 2px black; '>". $row['title']." <br></h2></center>";
				echo "<br>";
				echo "<table>";
				echo "<tr>";
				echo "<td><div style='padding-right: 50px; padding-left: 50px;'><img src='images/".$row['image']."'style='widht:250px; height: 250px'></div></td>"; 
				echo "<br>";
				echo "<br>";
				echo "<td><div style='font-size: 12px; font-family: consolas; '>".$row['msg']."</div></td>";
				echo "</tr>";
				echo "<table>";
				
				while($row2 = mysqli_fetch_assoc($result2)){
				    echo "<div style='margin: 10px; color: grey;'>Posted by: ".$row2['name']." ".$row2['last']." (".$row2['user'].") | at ";
				    
				}
				echo $row['date']."</div>";
				echo "<br>";echo "<br>";echo "<br>";
				echo "</div>";

				}
	
		echo "</div>";

	?>

</body>
</html>