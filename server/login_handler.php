<?php

// foreach (glob("../classes/*.php") as $filename)
// {
//     require_once $filename;
// }

require_once('../classes/Database.class.php');
require_once('../classes/User.class.php');

$username = $usernameError = "";
$name = $nameError = "";
$email = $emailError = "";
$password = $passwordError = "";

if (isset($_POST['signup'])) {
    header('Location: ../views/register.php');
    exit();
}

if (isset($_POST['login'])) {
    $errors = array();
    if (empty(trim($_POST['username']))) {
        $usernameError = "Username should not be empty!";
        $errors['username'] = "username=" . $usernameError;
    } else {
        $username = $_POST['username'];
    }

    if (empty(trim($_POST['username']))) {
        $emailError = "Email should not be empty!";
        $errors['email'] = "email=" . $emailError;
    } else {
        $email = $_POST['email'];
    }

    if (strlen(trim($_POST['password'])) < 6) {
        $passwordError = "Password must contain at least 6 characters!";
        $errors['password'] = 'password=' . $passwordError;
    } else {
        $password = $_POST['password'];
    }

    if (!empty($errors)) {
        $errors_string = implode('&', $errors);

        header("Location: ../views/login.php?" . $errors_string);
    }

    $db = new Database();
    $db->getConnection();

    $user = new User($db->pdo);
    $login = $user->login($username, $password);
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
    $_SESSION['user_id'] = $login['id'];
    $_SESSION['user_name'] = $login['name'];
    header('Location: ../index.php');
    exit();
}

// $database = new Database();
