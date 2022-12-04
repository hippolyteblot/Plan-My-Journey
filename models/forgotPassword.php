<?php
include_once(PATH_MODELS . 'Connexion.php');

function sendMail($email)
{
  $user = getUserByEmail($email);
  if ($user) {
    $token = uniqid();
    $link = "http://localhost:8080/index.php?page=resetPassword&token=" . $token;
    $message = "Bonjour " . $user['firstname'] . " " . $user['lastname'] . ",\n\n";
    $message .= "Vous avez demandé à réinitialiser votre mot de passe.\n";
    $message .= "Pour ce faire, veuillez cliquer sur le lien suivant : " . $link . "\n\n";
    $message .= "Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer ce mail.\n\n";
    $message .= "Cordialement,\n";
    $message .= "L'équipe de ProjetWeb";
    $headers = "From: " . MAIL . "\r\n";
    $headers .= "Reply-To: " . MAIL . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $subject = "Réinitialisation de votre mot de passe";
    if (mail($email, $subject, $message, $headers)) {
      $alert = [
        'messageAlert' => "Un mail vous a été envoyé pour réinitialiser votre mot de passe.",
        'classAlert' => "success"
      ];
      require_once(PATH_CONTROLLERS . 'mail.php');
      $token = password_hash($token, PASSWORD_DEFAULT);
      $id = $user['user_id'];
      $db = Connexion::getInstance()->getBdd();
      $query = $db->prepare("UPDATE user SET token = :token WHERE user_id = :id");
      $query->execute([
        'token' => $token,
        'id' => $id
      ]);
    } else {
      $alert = [
        'messageAlert' => "Une erreur est survenue lors de l'envoi du mail.",
        'classAlert' => "error"
      ];
    }
  } else {
    $alert = [
      'messageAlert' => "Aucun compte n'est associé à cette adresse mail.",
      'classAlert' => "error"
    ];
  }
  return $alert;
}

function getUserByEmail($email)
{
  $db = Connexion::getInstance()->getBdd();
  $query = $db->prepare("SELECT * FROM user WHERE email = :email");
  $query->execute([
    'email' => $email
  ]);
  return $query->fetch();
}
