<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
};

$title = "Dashboard";
require '../includes/header.php';
?>

<?php 
if (isset($_SESSION['user'])) {
  echo "Welcome, " . $_SESSION['user_first_name'];
}
?>

<?php
require '../includes/footer.php';

