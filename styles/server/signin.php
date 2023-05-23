<?php

// foreach (glob("../classes/*.php") as $filename)
// {
//     require_once $filename;
// }

require_once('../classes/Database.class.php');
require_once('../classes/User.class.php');

$username_or_email = $username_or_emailError = "";
$password = $passwordError = "";

if (isset($_GET['signup'])) {
    $errors = array();
    header('Location: ../views/register.php');
    exit();
}

if (isset($_GET['login'])) {
    if (empty(trim($_GET['username_or_email']))) {
        $username_or_emailError = "Username or email should not be empty!";
        $errors['username_or_email'] = "username_or_email=" . $username_or_emailError;
    } else {
        $username_or_email = $_GET['username_or_email'];
    }

    if (strlen(trim($_GET['password'])) < 6) {
        $passwordError = "Password must contain at least 6 characters!";
        $errors['password'] = 'password=' . $passwordError;
    } else {
        $password = $_GET['password'];
    }

    if (!empty($errors)) {
        $errors_string = implode('&', $errors);

        header("Location: ../views/login.php?" . $errors_string);
    }

    $db = new Database();
    $db->getConnection();

    $user = new User($db->pdo);
    $login = $user->login($username_or_email, $password);
    if (!$login) {
        $login_error = "login=User not found. Enter a correct username or email!";
        header('Location: ../views/login.php?' . $login_error);
        exit();
    }

    if ($login == 'Password is incorrect!') {
        header('Location: ../views/login.php?password=' . $login);
        exit();
    }

    session_start();
    $_SESSION['user'] = $login;
    $_SESSION['user_id'] = $login['id'];
    $_SESSION['user_first_name'] = $login['first_name'];
    header('Location: ../views/index.php');
    exit();
}

// $database = new Database();
