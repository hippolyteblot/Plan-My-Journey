<?php
require_once('config/phpmailer/Exception.php');
require_once('config/phpmailer/PHPMailer.php');
require_once('config/phpmailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'localhost';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  // $mail->Username   = ' ';                     // SMTP username
  // $mail->Password   = ' ';                               // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  //CharSet
  $mail->CharSet = 'UTF-8';

  //Recipients
  $mail->setFrom('no-reply@planmyjourney.com'); // Email de l'expéditeur
  $mail->addAddress(' ');     // Email du destinataire

  // Content
  $mail->isHTML(true);
  $mail->Subject = 'Récupération de mot de passe';
  $mail->Body    = 'Salut salut'; // Contenu du mail
  $mail->AltBody = 'Salut salut'; // Contenu du mail sans HTML

  $mail->send();
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
