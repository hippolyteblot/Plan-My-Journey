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
  $mail->SMTPDebug = 0;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.mailgun.org';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'postmaster@sandbox47f9092170d5485b8e4bdb9387993fdc.mailgun.org';                     // SMTP username
  $mail->Password   = '1769473dad4ffec5374b769929de6b55-4c2b2223-344ef7f9';                               // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('postmaster@sandbox47f9092170d5485b8e4bdb9387993fdc.mailgun.org', 'Mailer');
  $mail->addAddress('bytox.gnt@gmail.com', 'User');     // Add a recipient

  // Content
  $mail->isHTML(true);
  $token = uniqid();                               // Set email format to HTML
  $mail->Subject = 'Récupération de mot de passe';
  $mail->Body    = 'Voici votre lien de récupération de mot de passe : <a href="http://example.com/resetpassword?token=' . $token . '">Réinitialiser le mot de passe</a>';
  $mail->AltBody = 'Voici votre lien de récupération de mot de passe : http://example.com/resetpassword?token=' . $token;

  $mail->send();
  echo '<script>alert("Le lien de récupération de mot de passe a été envoyé à l\'adresse e-mail.")</script>';
} catch (Exception $e) {
  echo "<script>alert('Le message n'a pas pu être envoyé. Erreur de mailer: {$mail->ErrorInfo}')</script>";
}
