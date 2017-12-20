    <?php
			require_once("connect.php");
			require_once("check.php");
			date_default_timezone_set('America/Sao_Paulo');
			
			if (isset($_POST['submit'])) {
	
			// Recupera os dados dos campos
			$date = date_create();
			$title = $_POST['title'];
			$email = $_POST['email'];
			$msg = $_POST['msg'];
			$user = $_SESSION['idUser'];
			$picture = $_FILES["picture"];
			$time = date("Y-m-d H:i:s");;
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
					    require_once("check.php");
						echo "<style> body { background-color: black;} </style>";
						echo "<div style='margin-top: 200px; margin-left: 500px; background-color: grey; border-radius: 5px; padding: 5px; width: 300px;'>";
						echo "<a href='feed.php' style='text-decoration: none;  color: #EEE8AA;'>";
						echo "<center> <h1 style='color: #EEE8AA; text-shadow: 2px 3px 2px black;'> Uploaded </h1> </center>";
						echo "<center><h2 style=' color: #EEE8AA; text-shadow: 2px 2px 2px black;'>Back to feed </a></h2></center>";
						echo "</div>";
						
					}
				}
			
				// Se houver mensagens de erro, exibe-as
				if (count($error) != 0) {
					foreach ($error as $erro) {
						echo $erro . "<br />";
					}
				}
			}

				require_once("phpmailer/class.phpmailer.php");
				require_once("phpmailer/class.smtp.php");

				$mail = new PHPMailer(true);                             // Passing `true` enables exceptions
				try {
				    //Server settings
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'd3arwedding@gmail.com';                 // SMTP username
				    $mail->Password = 'dearwedding';                           // SMTP password
				    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 465;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom('d3arwedding@gmail.com', 'Dear Wedding');
				    $mail->addAddress($email, $user);     // Add a recipient
				    //$mail->addAddress($email);               // Name is optional
				    // $mail->addReplyTo('info@example.com', 'Information');
				    // $mail->addCC('cc@example.com');
				    // $mail->addBCC('bcc@example.com');

				    //Attachments
				    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = "Dear Wedding | ".$title;
				    $mail->Body    = "You received a message. '".$msg."'... Check on dearwedding.000webhostapp!";
				    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    echo 'Message has been sent';
				} catch (Exception $e) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
?>