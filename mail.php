<?php
		require_once('phpmailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->SetLanguage("en", 'includes/phpMailer/language/');
	    $mail->CharSet =  "utf-8";
	    $mail->IsSMTP();
	    $mail->SMTPDebug = 3;
	    $mail->SMTPAuth = true;
	    $mail->Username = "abhijeetshidhaye506@gmail.com";
	    $mail->Password = "jyoti2321398";
		$mail->SMTPSecure = 'tls';
	    $mail->Host = "smtp.gmail.com";
	    $mail->Port = "587";

		$mail->setFrom('bhupendra@walkingdreamz.com', 'abhijeet');
		$mail->AddAddress("abhijeet@walkingdreamz.com");
        //$mail->AddAddress("djaftab@gmail.com");

		$mail->Subject = "Work with us";
		$mail->Body = "<p style='font-weight:bold;'>Message</p>";
		$mail->ContentType = "text/html";

		
		if($mail->Send()){
			$str = "OK";	
		}else{
			$str = "ERR";	
		}
?>		