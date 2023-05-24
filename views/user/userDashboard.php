<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
  header('location: ../index.php');
}
$title = "User Dashboard";
include '../../includes/header.php';
include '../../includes/navbar.php';

require '../../classes/database.class.php';
$db = new Database();
$db->getConnection();
?>

</head>
<body>

<div class="bg-dark m-3 p-2">
  <div class="container-md">
    <div class="d-flex flex-wrap align-items-center justify-content-center">
    <?php $sql = "SELECT * FROM elections";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute();
    $elections = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($elections as $election) {
      echo "<div class='card' style='width: 36rem;'>
    <div class='card-body'>
      <h5 class='card-title'>" . $election['title'] . "</h5>
      <h6 class='card-subtitle mb-2 text-muted'>Card subtitle</h6>
      <p class='card-text'>" . $election['description'] . "</p>
      <a href='#' class='card-link'>" .$election['start_date'] . "</a>
      <a href='#' class='card-link'>" . $election['end_date'] . "</a>
    </div>
  </div>";
    }
    ?>
  </div>
</div>
  


<?php
include '../../includes/dashboard_footer.php';
include '../../includes/footer.php';
?>