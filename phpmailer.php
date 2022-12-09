<?php
function sendmail($mailname,$mailto, $mailsubject, $mailmsg)
{
	require 'PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'md-in-82.webhostbox.net';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'testmail@technopulse.in';                 // SMTP username
	$mail->Password = 'q1w2e3r4/';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->From = 'testmail@technopulse.in';
	$mail->FromName = 'Mailer';
	$mail->addAddress($mailto, $mailname);     // Add a recipient
	$mail->addAddress('aravinda@technopulse.in');               // Name is optional
	$mail->addReplyTo('aravinda@technopulse.in', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $mailsubject;
	$mail->Body    = $mailmsg;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'Message has been sent';
	}
}
?>