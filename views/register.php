<?php $title = "Sign Up Page";
require '../includes/header.php' ?>

<?php
if (isset($_GET['username'])) {
  $usernameError = $_GET['username'];
}

if (isset($_GET['email'])) {
  $emailError = $_GET['email'];
}

if (isset($_GET['password'])) {
  $passwordError = $_GET['password'];
}

if (isset($_GET['confirm_password'])) {
  $confirm_passwordError = $_GET['confirm_password'];
}
?>

<body>
  <div class="body-wrapper">
    <form action="../server/register_handler.php" name="register" method="POST" class="form-group" id="register">
      <div class="d-flex align-items-center justify-content-center gap-3">
        <img src="../assets/login.png" alt="vote" style="height: 300px; width: 300px;" class="px-4 py-5">
        <div class="d-flex flex-column align-items-center justify-content-center my-2 mx-3" style="height: 100vh;">
          <p class="text-center text-danger m-3" id="register-error"></p>
          <h1 class="text-white m-3">Sign Up</h1>
          <input type="text" name="name" id="name" class="form-control bg-whitesmoke px-3 py-2 m-2" placeholder="Name">
          <input type="text" name="username" id="username" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($usernameError) ? 'is-invalid' : null ?>" placeholder="Username">
          <?php if (isset($usernameError)) : ?>
            <small class="text-danger my-1"><?php echo $usernameError ?></small>
          <?php endif ?>
          <input type="email" name="email" id="email" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($emailError) ? 'is-invalid' : null ?>" placeholder="Email">
          <?php if (isset($emailError)) : ?>
            <small class="text-danger my-1"><?php echo $emailError ?></small>
          <?php endif ?>
          <input type="password" name="password" id="password" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($passwordError) ? 'is-invalid' : null ?>" placeholder="Password">
          <?php if (isset($passwordError)) : ?>
            <small class="text-danger my-1"><?php echo $passwordError ?></small>
          <?php endif ?>
          <input type="password" name="confirm_password" id="confirm_password" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($confirm_passwordError) ? 'is-invalid' : null ?>" placeholder="Confirm Password">
          <?php if (isset($confirm_passwordError)) : ?>
            <small class="text-danger my-1"><?php echo $confirm_passwordError ?></small>
          <?php endif ?>
          <button type="submit" id="signup" name="register" class="px-3 py-2 bg-green my-2">Sign Up</button>
        </div>
      </div>
    </form>
  </div>
</body>

<?php require '../includes/footer.php' ?>