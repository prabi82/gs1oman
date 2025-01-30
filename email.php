 <?php 
 use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
	$mail = new PHPMailer(true);
	$mail->isSMTP(); 
	    $mail->SMTPDebug = 2;
	    $mail->Host       = 'host33.theukhost.net';                     
	    $mail->SMTPAuth   = true;                                   
	    $mail->Username   = 'info@gs1oman.com';                    
	    $mail->Password   = 'd4.rX%J6H55{';                             
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
	    $mail->Port       = 465;      

$mail->setFrom('info@gs1oman.com', 'Barcode');
	    //$mail->addAddress($user_email);
	    $mail->addAddress('navpreet.abstain@gmail.com');	

$mail->isHTML(true);                                 
	    $mail->Subject = 'Barcode:New Registration';
	    $mail->Body    = 'testing mail';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		  if($mail->send()){
		  echo "1";
		  }
		  else{
			  echo "2";
		  }
		
	

    
	
		?>