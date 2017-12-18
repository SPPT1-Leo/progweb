<?php

		require_once("connect.php");
		require_once("check.php");
	
		// $picture = $_FILES['picture'];
		// $title = $_POST['title'];
		// $email = $_POST['email'];
		// $msg = $_POST['msg'];
		// $user = $_SESSION['idUser'];
		// $time = now();

		//POST
		
			// CÓDIGO AQUI
		
		//Verifica se a foto foi selecionada

		if(isset($_POST['Submit'])){

			$picture = $_FILES['picture'];
			$title = $_POST['title'];
			$email = $_POST['email'];
			$msg = $_POST['msg'];
			$user = $_SESSION['idUser'];
			$time = now();

			if(!empty($picture["name"])){

				$error = array();

				// Verifica se é uma imagem

				if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $picture["type"])){

					$error[1] = "Isso não é uma imagem!";

				}

				//Pega as dimensões da imagem
				$dimensoes = getimagesize($foto['tmp_name']);

				if(count($error) == 0){

					//Pega a extensão da imagem.
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $picture["name"], $ext);

					//Gera um nome único para a imagem
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

					//Caminho onde ficará a imagem
					$caminho_imagem = "images/" . $nome_imagem;

					//Faz o upload da imagem para a pasta
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);

					//Insere os dados no banco
					$sql = mysqli_query("INSERT INTO post (title, msg, image, date, user) VALUES ($title, $msg, $picture, $time, $user);");

					//Verifica se os dados foram inseridos com sucesso
					if($sql){
						echo "Upload complete";
					}

				}

				//Mostra os erros caso ocorram
				if(count($error) != 0 ){

					foreach ($error as $erro) {
						echo $erro."<br />";
					}

				}

			}


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
