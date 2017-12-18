<?php

		require_once("connect.php");
		require_once("check.php");
	
		$picture = $_FILES['picture'];
		$title = $_POST['title'];
		$email = $_POST['email'];
		$msg = $_POST['msg'];
		$user = $_SESSION['idUser'];
		$time = now();

		//POST
		
			// CÓDIGO AQUI

		if(isset($_POST['Submit'])){

			$nomeFinal = time().'.jpg';
			if(move_uploaded_file($picture['tmp_name'], $nomeFinal)){

				$tamanhoImg = filesize($nomeFinal);

				$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));

				var_dump($mysqlImg);

				$sql = "INSERT INTO post (title, msg, image, date, user) values ('$title', '$msg', $picture, $time, '$user');"

				$result = mysqli_query($mysqli, $sql);

				echo "Picture uploaded successfully";

				unlink($nomeFinal);

				header("location: feed.php");

			}

		} else {

			echo "Upload error";

		}



		// SEND E-MAIL:

		$send = "Title: $title\n Message: $msg";

		require_once("phpmailer/class.phpmailer.php");

		define('GUSER', 'd3arwedding@gmail.com');	// <-- Insira aqui o seu GMail
		define('GPWD', 'dearwedding');
		
		function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 

			global $error;
			$mail = new PHPMailer();
			$mail->IsSMTP();		// Ativar SMTP
			$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
			$mail->SMTPAuth = true;		// Autenticação ativada
			$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
			$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
			$mail->Port = 465;  		// A porta 465- 587 deverá estar aberta em seu servidor
			$mail->Username = GUSER;
			$mail->Password = GPWD;
			$mail->SetFrom($de, $de_nome);
			$mail->Subject = $assunto;
			$mail->Body = $corpo;
			$mail->AddAddress($para);
			if(!$mail->Send()) {
				$error = 'Mail error: '.$mail->ErrorInfo; 
				return false;
			} else {
				$error = 'Mensagem enviada!';
				return true;
			}
		}

		// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
		//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

		if (smtpmailer($email, 'd3arwedding@gmail.com','DEAR WEDDING' , "E-mail de ".$email, $send)) {

			echo "Enviado com sucesso";

		}
		if (!empty($error)) echo $error;


?>
