<?php

// foreach (glob("../classes/*.php") as $filename)
// {
//     require_once $filename;
// }

require_once('../classes/Database.class.php');
require_once('../classes/User.class.php');

$username = $usernameError = "";
$email = $emailError = "";
$password = $passwordError = "";
$confirm_password = $confirm_passwordError = "";

if (isset($_POST['register'])) {
  $errors = array();
  // Validate First name
  if (empty(trim($_POST['first_name']))) {
    $first_name = NULL;
  } else {
    $first_name = trim($_POST['first_name']);
  }

  // Validate username
  if (empty(trim($_POST['username']))) {
    $usernameError = "Username should not be empty!";
    $errors['username'] = 'username=' . $usernameError;
  } else {
    $username = trim($_POST['username']);
  }

  // Validate email
  if (empty(trim($_POST['email']))) {
    $emailError = "Email should not be empty!";
    $errors['email'] = 'email=' . $emailError;
  } else {
    $email = trim($_POST['email']);
  }

  // Validate password
  if (empty(trim($_POST['password']))) {
    $passwordError = "Password should not be empty!";
    $errors['password'] = 'password=' . $passwordError;
  } else if (strlen(trim($_POST['password'])) < 6) {
    $passwordError = "Password should be at least 6 characters!";
    $errors['password'] = 'password=' . $passwordError;
  } else {
    $password = trim($_POST['password']);
  }

  // Validate confirm password
  if (trim($_POST['password'] !== trim($_POST['confirm_password']))) {
    $confirm_passwordError = "Passwords do not match!";
    $errors['confirm_password'] = 'confirm_password=' . $confirm_passwordError;
  } else {
    $confirm_password = trim($_POST['confirm_password']);
  }

  if (!empty($errors)) {
    $errors_string = implode('&', $errors);
    header("Location: ../views/register.php?" . $errors_string);
    exit();
  }

  $db = new Database();
  $db->getConnection();

  $user = new User($db->pdo);
  $user->setAttributes($first_name, $username, $email, $password);
  $register = $user->register();
  if (!$register) {
    $register_error = "register=Username, email, or password already exists!";
    header('Location: ../views/register.php?' . $register_error);
  }

  session_start();
  // $_SESSION['user'] = $user;
  $_SESSION['user_id'] = $register['user_id'];
  $_SESSION['user_first_name'] = $register['first_name'];
  $_SESSION['user_email'] = $register['email'];
  $url = '../views/email_verification.php?email=' . $_SESSION['user_email'];
  $_SESSION['token'] = $user->send_authentication_code($url);
  header($url);
  exit();
  // header('Location: ../views/index.php');
}
