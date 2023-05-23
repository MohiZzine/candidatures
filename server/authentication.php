<?php
session_start();
require '../classes/Database.class.php';
require '../classes/User.class.php';

if (isset($_POST['submit-code'])) {
  $digit_1 = $_POST['digit-1'];
  $digit_2 = $_POST['digit-2'];
  $digit_3 = $_POST['digit-3'];
  $digit_4 = $_POST['digit-4'];
  $digit_5 = $_POST['digit-5'];
  $digit_6 = $_POST['digit-6'];

  $code = $digit_1 . $digit_2 . $digit_3 . $digit_4 . $digit_5 . $digit_6;

  $db = new Database();
  $db->getConnection();
  $user = new User($db->pdo);
  $user->set_user_id($_SESSION['user_id']);
  if ($user->get_activation_expiry() < time()) {
    $authentication_error = "Code has expired! Another code has been sent to your email.";
    $url = '../views/email_verification.php?auth_error=' . $authentication_error . '&email=' . $_SESSION['user_email'];
    $token = $user->send_authentication_code($url);
    header($url);
    exit();
  }

  if ($user->verify_authentication_code($code)) {
    header('Location : ../views/index.php');
  } else {
    $authentication_error = "Code is invalid!";
    header('Location: ../views/email_verification.php?auth_error=' . $authentication_error . '&email=' . $_SESSION['user_email']);
    exit();
  }
}

if (isset($_POST['resend-code'])) {
  $email = $_SESSION['user_email'];
  $url = '../views/email_verification.php?email=' . $email;
  $token = $_SESSION['user']->send_authentication_code($url);
  header('Location: ' . $url);
  exit();
}
