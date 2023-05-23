<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
};

$title = "Dashboard";
require 'includes/header.php';
?>

<?php
// var_dump($_SESSION);
echo "Welcome, " . $_SESSION['user_email'];
?>

<?php
require 'includes/footer.php';
