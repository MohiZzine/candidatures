<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: views/login.php');
};

$title = "Dashboard";
require 'includes/header.php';
?>

<?php
?>

<body class="d-flex flex-column align-items-center justify-content-center gap-4" style="height: 100vh;">
  <div class="position-relative top-0 bg-primary p-3 text-center d-flex align-items-center justify-content-between">
    <form action="views/login.php" method="get">
      <h2>Welcome to the University Voting App</h2>
    </form>
    <button class="btn btn-danger px-2 py-3">Logout</button>
  </div>
  <?php
  $sql = "SELECT * FROM elections";
  $stmt = $db->pdo->prepare($sql);
  $stmt->execute();

  $elections = $stmt->fetchAll(PDO::FETCH_ASSOC);
  for ($i = 0; $i < count($elections); $i++) {
    $election = $elections[$i];
    $election_id = $election['id'];
    $election_name = $election['name'];
    $election_description = $election['description'];
    $election_start_date = $election['start_date'];
    $election_end_date = $election['end_date'];
    $election_status = $election['status'];
    $election_created_at = $election['created_at'];
    $election_updated_at = $election['updated_at'];
    $election_deleted_at = $election['deleted_at'];
    $elections[$i] = [
      'id' => $election_id,
      'name' => $election_name,
      'description' => $election_description,
      'start_date' => $election_start_date,
      'end_date' => $election_end_date,
      'status' => $election_status,
      'created_at' => $election_created_at,
      'updated_at' => $election_updated_at,
      'deleted_at' => $election_deleted_at
    ];
    echo "<div class='card text-white bg-dark mb-3' style='max-width: 18rem;'>
    <div class='card-header'>{$election_id}</div>
    <div class='card-body'>
      <h5 class='card-title'>{$election_title}</h5>
      <p class='card-text'>{$election_name}</p>
    </div>
  </div> 
    ";
  }
  ?>

</body>

<?php
require 'includes/footer.php';
