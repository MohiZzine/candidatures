<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




function sendMail($email, $rec_name, $ver_code, $url)
{
  try {
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'phpmailertest187@gmail.com';
    $mail->Password = 'PHPMAILERTEST';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set Mail details
    $mail->setFrom('phpmailertest187@gmail.com', 'Mohi');
    $mail->addAddress($email, $rec_name);
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer Test';
    $mail->Body = 'Your expiration code is: <b>' . $ver_code . '</b>. It will expire in 10 minutes.';
    $mail->AltBody = 'Your expiration code is: <b>' . $ver_code . '</b>. It will expire in 10 minutes.';
    $mail->Body = '\nPlease click the following link: <a>' . $url . '</a>';

    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
