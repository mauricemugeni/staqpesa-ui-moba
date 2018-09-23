<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.zoho.com; smtp.reflexconcepts.co.ke';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@reflexconcepts.co.ke';                 // SMTP username
$mail->Password = '20reflexco@14';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('info@reflexconcepts.co.ke', 'Reflex Concepts LTD');
$mail->addAddress('bellarmine16@gmail.com', 'Bellarmine Bulinda');     // Add a recipient
$mail->addAddress('bellarmine16@live.com');               // Name is optional
$mail->addAddress('bellarmine16@live.com');               // Name is optional
$mail->addAddress('bmugeni@reflexconcepts.co.ke');               // Name is optional
$mail->addAddress('eugean@reflexconcepts.co.ke');               // Name is optional
$mail->addReplyTo('do@staqpesa.com', 'Staqpesa Information');
$mail->addCC('help@reflexconecpts.co.ke');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'StaqpesaInfo: Test Mail with PHPMailer';
$mail->Body    = 'This is the HTML message body <b>in bold! <br/>WARNING: Respond if received.</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}