<?php
session_start();
$title = "PHP Login - Login Page";
$metaD = "The login page";
include 'header.php';
?>
    <div class="wrapper form-box">
      <h2 class="form-heading">User Login</h2>
      <form method="post" action="login-process.php">
          <input type="text" name="loginEmail" placeholder="Email" value="<?php if (isset($_SESSION['storeLoginEmail'])) { echo $_SESSION['storeLoginEmail']; unset($_SESSION['storeLoginEmail']); }; ?>">
          <br>
          <input type="password" name="loginPassword" placeholder="Password" value="">
          <span class="error"><?php if (isset($_SESSION['loginError'])) { echo $_SESSION['loginError']; unset($_SESSION['loginError']); }; ?></span>
          <br>
          <input class="submit btn-submit" name="submit" type="submit" value="Login">
        </form>
        <p>Don't have an account? <a class="form-link" href="registration">sign up!</a></p>
    </div>

<?php
  include 'footer.php';
?>
