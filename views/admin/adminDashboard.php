<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
}
$title = "Admin Dashboard";
include '../includes/header.php';
?>

<?php 
include '../includes/dashboard_footer.php';
include '../includes/footer.php';

require_once '../../classes/database.class.php';
?>