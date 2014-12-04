<?php  	
		/*if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$uploadedfile = $_FILES['file'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		if ( $movefile ) {
		    $wp_filetype = $movefile['type'];
		    $filename = $movefile['file'];
		    $wp_upload_dir = wp_upload_dir();
		    $attachment = array(
		        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
		        'post_mime_type' => $wp_filetype,
		        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		        'post_content' => '',
		        'post_status' => 'inherit'
		    );
		    $attach_id = wp_insert_attachment( $attachment, $filename);
		}*/
		
		
		$toemail = $_POST['email_send'];
		$email = $_POST['email'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$stanowisko = $_POST['stanowisko'];
		$tresc = $_POST['tresc'];
		$plik = $_POST['plik'];
		
		
		$temat = "=?utf-8?B?".base64_encode("Nowe zgłoszenie od {$imie} {$nazwisko}")."?=";
		$wiadomosc = "
		$tresc
		$stanowisko
		";
									
		$headers = 'From: =?utf-8?B?'.base64_encode("Koduj dla Polski").'?= <'. $email . '>' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion() . "\r\n" .
			   'Content-type: text/plain; charset=utf-8' . "\r\n";
							
			   mail($toemail, $temat, $wiadomosc, $headers);
	
		echo $imie . " " . $nazwisko . " " . $toemail . " " . $email . " " . $stanowisko . " " . $tresc;
		echo $plik;
		echo "Wiadomość została wysłana!";
	
?>