<?php $title = "Login"; require '../includes/header.php' ?>

<?php
  if (isset($_GET['username_or_email'])) {
    $username_or_emailError = $_GET['username_or_email'];
  }

  if (isset($_GET['password'])) {
    $passwordError = $_GET['password'];
  }
?>

<body class="container-fluid">
  <div class="row text-center">
    <div class="col-lg-9 d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
      <form action="../server/signin.php" method="GET" class="form-group" id="login">
        <p class="text-center text-danger m-3" id="submit-error"></p>
        <h1 class="fw-bold">Login to Your Account</h1>
        <small>Login using social networks</small>
        <div class="d-flex align-items-center justify-content-center">
          <i class="bi bi-facebook fa-lg px-3" id="facebook" style="font-size: 32px;"></i>
          <i class="bi bi-google px-3" id="google" style="font-size: 32px;"></i>
          <i class="bi bi-linkedin px-3" id="linkedin" style="font-size: 32px;"></i>
        </div>
        <div class="my-2 d-flex flex-column align-items-center justify-content-center">
          
          <input type="text" name="username_or_email" id="username_or_email" placeholder="Username or Email" class="form-control bg-whitesmoke px-3 py-2 m-2 <?php echo isset($username_or_emailError)? 'is-invalid':null ?> ">
          <?php if (isset($username_or_emailError)): ?>
            small
          <small class="text-danger my-1" id="username_or_email_error">
          <?php echo isset($username_or_emailError)  ?$username_or_emailError: '' ?>
          </small>
          <?php endif ?>
          <input type="password" name="password" id="password" placeholder="Password" class="form-control bg-whitesmoke px-3 py-2 m-2 mb-3 <?php echo isset($passwordError) ? 'is-invalid': null ?>"> 
          <small class="text-danger my-1" id="password_error"><?php echo isset($passwordError) ? $passwordError: '' ?></small>
          <button type="submit" name="login" class="bg-green text-center px-3 py-2 mt-2" id="login_button">Sign In</button>
        </form>
        </div>
      </div>
      <div class="col-lg-3 d-flex flex-column align-items-center justify-content-center bg-green text-center" id="sidebar">
        <h2>New Here?</h2>
        <p>Sign up and discover our new features and opportunities!</p>
        <button name="signup" class="px-3 py-2" id="signup">Sign Up</button>
      </div>
    </div>
<?php require '../includes/footer.php' ?>