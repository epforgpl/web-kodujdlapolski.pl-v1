<?php  	
		require_once("../../../../wp-load.php");
		date_default_timezone_set('Etc/UTC');
		require 'phpMailer/PHPMailerAutoload.php';
		
		//ZAPIS PLIKU
		
		if($_FILES["file"]["name"]){
		 
			$target_dir = "../../../uploads/emails/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$uploadOk = 1;
			
			
			$allowedExts = array(
			  "pdf", 
			  "doc", 
			  "docx"
			); 
			
			$allowedMimeTypes = array( 
			  'application/msword',
			  'application/pdf'
			);
	
			$extension = end(explode(".", $_FILES["file"]["name"]));
			
			// Czy to rozszerzenie jest dozwolone
			if ( ! ( in_array($extension, $allowedExts ) ) ) {
			  echo "Niedozwolone rozszerzenie pliku!<br>";
			  $uploadOk = 0;
			}
			
			// Czy ten typ pliku jest dozwolony
			if ( ! (in_array( $_FILES["file"]["type"], $allowedMimeTypes ) ) ) {
				echo "Niedozwolony typ pliku!<br>";
				$uploadOk = 0;
			}
			    
				// Czy taki plik już istnieje
				if (file_exists($target_file)) {
				    echo "Taki plik już istnieje.<br>";
				    $uploadOk = 0;
				}
				
	
			if ($uploadOk == 0) {
			    echo "Wystąpił błąd w zapisie załącznika.<br>";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			    	$attachments = array( WP_CONTENT_DIR . '/uploads/emails/' . $_FILES["file"]["name"] );
			        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			    } else {
			        echo "Wystąpił błąd w zapisie załącznika.<br>";
			    }
			}
		}

		
		$id = $_POST['id'];
		$toemail = get_field('email', $id);
		
		$email = $_POST['email'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$stanowisko = $_POST['stanowisko'];
		$tresc = $_POST['tresc'];
		
		$tresc = nl2br($tresc);
		
		if ($stanowisko == "Zaproponuj temat"){
			$temat = "[KdP] Propozycja tematu od {$imie} {$nazwisko}";
			$wiadomosc = "
			Otrzymałeś/aś nową propozycje tematu od <b>{$imie} {$nazwisko}</b>.<br><br> 
			
			Oto jego treść:<br>
			<i>{$tresc}</i>
			
			<br><br>---<br>
			Koduj dla Polski
			";
		} else {
			$temat = "[KdP] Zgłoszenie do projektu od {$imie} {$nazwisko}";
			$wiadomosc = " 
			Otrzymałeś/aś nowe zgłoszenie od <b>{$imie} {$nazwisko}</b> na stanowisko <b>{$stanowisko}</b>.<br><br> 
			
			Oto jego treść:<br>
			<i>{$tresc}</i>
			
			<br><br>---<br>
			Koduj dla Polski
			";
		}
		
		
		$mail = new PHPMailer;
		$mail->isSMTP();
		
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPAuth = true;
		
		$mail->Username = MAILER_USER;
		$mail->Password = MAILER_PASS;
		
		$mail->CharSet = 'utf-8';

		$mail->setFrom( $email, 'Koduj dla Polski');
		$mail->addCC($email, "$imie $nazwisko");
		$mail->AddReplyTo($email, "$imie $nazwisko");
		$mail->addAddress($toemail);
		
		$mail->Subject = $temat;
		$mail->msgHTML( $wiadomosc );	
		
		
		if($_FILES["file"]["name"]){
			$mail->addAttachment( WP_CONTENT_DIR . '/uploads/emails/' . $_FILES["file"]["name"] );
		}
		
		if (!$mail->send()) {
		    echo "Błędy: " . $mail->ErrorInfo;
		} else {
		    echo "Wiadomość została wysłana! " . $toemail;
		}
							
		
?>
