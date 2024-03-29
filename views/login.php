<?php $title = "Login Page";
require '../includes/header.php' ?>

<?php
if (isset($_GET['username'])) {
  $username = $_GET['username'];
}

if (isset($_GET['email'])) {
  $emailError = $_GET['email'];
}

if (isset($_GET['password'])) {
  $passwordError = $_GET['password'];
}
?>


<body class="container-fluid">
  <div class="text-center body-wrapper">
    <form action="../server/login_handler.php" method="POST" class="form-group" id="login">
      <div class="d-flex flex-column align-items-center justify-content-center" style="height: 90vh;">
        <p class="text-center text-danger m-3" id="submit-error"></p>
        <h1 class="fw-bold text-white">Login to Your Account</h1>
        <div class="d-flex align-items-center justify-content-center gap-5">
          <img src="../assets/login.png" alt="vote" style="height: 300px; width: 300px;" class="px-4 py-5">

          <div class="my-2 d-flex flex-column align-items-center justify-content-center">
            <input type="text" name="username" id="username" placeholder="Username" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($usernameError) ? 'is-invalid' : null ?> ">
            <?php if (isset($usernameError)) : ?>
              <small class="text-danger my-1" id="username_error">
                <?php echo isset($usernameError)  ? $usernameError : '' ?>
              </small>
            <?php endif ?>
            <input type="email" name="email" id="email" placeholder="email" class="form-control bg-whitesmoke px-3 py-2 m-2 mb-3 <?php echo isset($emailError) ? 'is-invalid' : null ?>">
            <?php if (isset($emailError)) : ?>
              <small class="text-danger my-1" id="email_error">
                <?php echo isset($emailError)  ? $emailError : '' ?>
              </small>
            <?php endif ?>
            <input type="password" name="password" id="password" placeholder="password" class="form-control bg-whitesmoke px-3 py-2 m-2 mb-3 <?php echo isset($passwordError) ? 'is-invalid' : null ?>">
            <?php if (isset($passwordError)) : ?>
              <small class="text-danger my-1" id="password_error">
                <?php echo isset($passwordError)  ? $passwordError : '' ?>
              </small>
            <?php endif ?>
            <small class="text-danger my-1" id="email_error"><?php echo isset($emailError) ? $emailError : '' ?></small>
            <div class="d-flex align-items-center justify-content-center gap-4">
              <button type="submit" name="login" class="bg-green text-center px-3 py-2 mt-2" id="login_button">Sign In</button>
              <button name="signup" class="bg-danger text-light px-3 py-2" id="signup">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php require '../includes/footer.php' ?>