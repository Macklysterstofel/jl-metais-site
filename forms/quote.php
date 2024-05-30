<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Manually include the PHPMailer files
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'runescapeland5@gmail.com'; // Your email
        $mail->Password = 'restaurante01'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('mktstofel@gmail.com'); // Your receiving email address

        //Content
        $mail->isHTML(false);
        $mail->Subject = 'Solicitação de Orçamento';
        $mail->Body    = "Nome: $name\nEmail: $email\nTelefone: $phone\nMensagem: $message";

        $mail->send();
        echo 'Sua solicitação de orçamento foi enviada com sucesso. Obrigado!';
      } catch (Exception $e) {
          echo "Falha ao enviar solicitação de orçamento. Mailer Error: {$mail->ErrorInfo}";
      }
  } else {
      echo 'Método de solicitação inválido.';
  }
  ?>
  
       
