<?php
session_start();
$title = "Email Verification";
require '../includes/header.php' ?>

<?php
if (isset($_GET['email'])) {
  $email = $_GET['email'];
}

?>

<body class="container d-flex flex-column align-items-center justify-content-center text-center m-3" style="height: 100vh;">
  <form action="../server/authentication.php" method="POST">
    <h2>Authentication</h2>
    <small>Enter the 6-digit code you have received at <strong><?php echo $email ?></strong>.</small>
    <div class="d-flex align-items-center justify-content-center m-3">
      <input type="number" name="digit-1" class="digit" id="digit-1" min="0" max="9" value="0"><input type="number" class="digit" name="digit-2" id="digit-2" min="0" max="9" value="0"><input type="number" class="digit" name="digit-3" id="digit-3" min="0" max="9" value="0"><input type="number" class="digit" name="digit-4" id="digit-4" min="0" max="9" value="0"><input type="number" class="digit" name="digit-5" id="digit-5" min="0" max="9" value="0"><input type="number" class="digit" name="digit-6" id="digit-6" min="0" max="9" value="0">
    </div>
    <div class="d-flex align-items-center justify-content-center">
      <button type="submit" name="submit-code" id="submit-code" class="mx-2">Submit</button>
      <button name="resend-code" id="resend-code" class="mx-2">Resend Code</button>
    </div>
    <?php if (isset($_GET['auth_error'])) : ?>
      <small class="text-center text-danger m-3">
        <?php echo $_GET['auth_error'] ?>
      </small>
    <?php endif ?>
  </form>

  <?php require '../includes/footer.php' ?>