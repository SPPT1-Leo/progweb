<!DOCTYPE html>
<html lang="pt-br">
<head>

	<title> Dear Wedding </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--- FAVICON -->

    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

	<!--- CSS -->

	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body>

<div class="container">

	<div class="login-container">

            <div id="output"></div>

            <img src="img/loguinho.png" class="logo">

            <div class="form-box">

                <form action="verifica.php" method="post">

                    <input name="user" type="text" placeholder="username">

                    <input type="password" placeholder="password" name="passwd">

                    <button class="btn btn-info btn-block login" type="submit" name="go">login</button>

                </form>

            </div>
            
        </div>
        
</div>


</body>
</html>