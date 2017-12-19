<?php

			require_once("connect.php");
			require_once("check.php");

			if (isset($_POST['submit'])) {
	
			// Recupera os dados dos campos
			$date = date_create();
			$title = $_POST['title'];
			$email = $_POST['email'];
			$msg = $_POST['msg'];
			$user = $_SESSION['idUser'];
			$picture = $_FILES["picture"];
			$time = date_timestamp_get($date);

			// Se a foto estiver sido selecionada
			if (!empty($picture["name"])) {
		 
				$error = array();
		 
		    	// Verifica se o arquivo é uma imagem
		    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $picture["type"])){
		     	   $error[1] = "This is not a image.";
		   	 	} 
			
				// Pega as dimensões da imagem
				$size = getimagesize($picture["tmp_name"]);
		 
				// Se não houver nenhum erro
				if (count($error) == 0) {
				
					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $picture["name"], $ext);
		 
		        	// Gera um nome único para a imagem
		        	$image_name = md5(uniqid(time())) . "." . $ext[1];
		 
		        	// Caminho de onde ficará a imagem
		        	$image_path = "images/" . $image_name;
		 
					// Faz o upload da imagem para seu respectivo caminho
					move_uploaded_file($picture["tmp_name"], $image_path);
				
					// Insere os dados no banco
					$sql = mysqli_query($mysqli,"INSERT INTO `post` (title, msg, image, date, user) VALUES ('".$title."', '".$msg."', '".$image_name."', '".$time."', '".$user."')");
				
					// Se os dados forem inseridos com sucesso
					if ($sql){
						echo "Upload sucessfully.";
					}
				}
			
				// Se houver mensagens de erro, exibe-as
				if (count($error) != 0) {
					foreach ($error as $erro) {
						echo $erro . "<br />";
					}
				}
			}
		}

		// SEND E-MAIL:

		$send = "Title: ".$title."Message: ".$msg;

		require("phpmailer/class.phpmailer.php");

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
