<?php  	
		require_once("../../../../wp-load.php");
		
		
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

		
		
		
		$toemail = $_POST['email_send'];
		$email = $_POST['email'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$stanowisko = $_POST['stanowisko'];
		$tresc = $_POST['tresc'];
		
		if ($stanowisko == "Zaproponuj temat"){
			$temat = "=?utf-8?B?".base64_encode("Nowa propozycja tematu od {$imie} {$nazwisko}")."?=";
			$wiadomosc = "
			Otrzymałeś/aś nową propozycje tematu od {$imie} {$nazwisko}. 
			
			Oto jego treść:
			<b>{$tresc}</b>
			
			Stanowisko: <b>P$stanowisko}</b>
			
			
			---
			Koduj dla Polski
			";
		} else {
			$temat = "=?utf-8?B?".base64_encode("Nowe zgłoszenie od {$imie} {$nazwisko}")."?=";
			$wiadomosc = "
			Otrzymałeś/aś nowe zgłoszenie od {$imie} {$nazwisko}. 
			
			Oto jego treść:
			<b>{$tresc}</b>
			
			Stanowisko: <b>{$stanowisko}</b>
			
			
			---
			Koduj dla Polski
			";
		}
		
									
		$headers = 'From: ' . $email . ' <mailer@kodujdlapolski.pl>' . "\r\n";
		
		wp_mail($toemail, $temat, $wiadomosc, $headers, $attachments);
							
		
		echo "Wiadomość została wysłana!";		
?>