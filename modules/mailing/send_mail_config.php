<?php
require_once WPATH . "modules/mailing/PHPMailerAutoload.php";

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
$mail->addAddress('eugean@reflexconcepts.co.ke');               // Name is optional
$mail->addReplyTo('do@staqpesa.com', 'Staqpesa Information');
$mail->addCC('help@reflexconcepts.co.ke');
$mail->isHTML(true);                                  // Set email format to HTML
?>