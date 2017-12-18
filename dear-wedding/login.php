<!DOCTYPE html>
<html lang="pt-br">
<head>

	<title> Dear Wedding </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--- CSS -->

	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>
<!---
<center>
<div id='login'> 
<form action="verifica.php" method="post">
	
	<label>User: </label>
		<input type="text" name="user"> <br><br>
	<label>Password: </label>
		<input type="password" name="passwd"><br><br>
	<input type="submit" name="go">

</form>
</div>
</center>
-->

<div class="container">
	<div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <form action="verifica.php" method="post">
                    <input name="user" type="text" placeholder="username">
                    <input type="password" placeholder="password" name="passwd">
                    <button class="btn btn-info btn-block login" type="submit" name="go">Login</button>
                </form>
            </div>
        </div>
        
</div>


</body>
</html>