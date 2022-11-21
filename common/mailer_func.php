<?php
	include_once('class.phpmailer.php');
	function SendMail($email_HTML_file, $sender_email, $sender_name, $email_subject, $recipient_email, $recipient_name) {
		$mail             = new PHPMailer(); // defaults to using php "mail()"

		$body             = $email_HTML_file;
		$body             = eregi_replace("[\]",'',$body);


		$mail->From       = $sender_mail;
		$mail->FromName   = $sender_name;

		$mail->Subject    = $email_subject;

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($body);

		$mail->AddAddress($recipient_email, $recipient_name);

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  echo "Message sent!";
		}
	}
?>
