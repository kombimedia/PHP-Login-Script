<?php
session_start();
$title = "PHP Login - Registration Page";
$metaD = "The registration page";
include 'header.php';
?>
    <span class="db-error"><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></span>
    <div class="wrapper form-box">
        <h2 class="form-heading">Register New User</h2>
        <form method="post" action="reg-process.php">
            <!-- <label class="required" for="name">First Name </label> -->
            <input type="text" name="name" placeholder="First Name *" value="<?php if (isset($_SESSION['storeName'])) { echo $_SESSION['storeName']; unset($_SESSION['storeName']); }; ?>">
            <span class="error"><?php if (isset($_SESSION['nameError'])) { echo $_SESSION['nameError']; unset($_SESSION['nameError']); }; ?></span>
            <br>
            <!-- <label class="required" for="sName">Last Name </label> -->
            <input class="required" type="text" name="sName" placeholder="Last Name *" value="<?php if (isset($_SESSION['storeSName'])) { echo $_SESSION['storeSName']; unset($_SESSION['storeSName']); }; ?>">
            <span class="error"><?php if (isset($_SESSION['sNameError'])) { echo $_SESSION['sNameError']; unset($_SESSION['sNameError']); }; ?></span>
            <br>
            <!-- <label class="required" for="email">Email </label> -->
            <input type="text" name="email" placeholder="Email *" value="<?php if (isset($_SESSION['storeEmail'])) { echo $_SESSION['storeEmail']; unset($_SESSION['storeEmail']); }; ?>">
            <span class="error"><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></span>
            <br>
            <!-- <label class="required" for="password">Password </label> -->
            <input type="password" name="password" placeholder="Password *" value="<?php if (isset($_SESSION['storePassword'])) { echo $_SESSION['storePassword']; unset($_SESSION['storePassword']); }; ?>">
            <span class="error"><?php if (isset($_SESSION['passError'])) { echo $_SESSION['passError']; unset($_SESSION['passError']); }; ?></span>
            <br>
            <!-- <label class="required" for="confirmPassword">Confirm Password </label> -->
            <input type="password" name="confirmPassword" placeholder="Confirm Password *" value="<?php if (isset($_SESSION['storeConfirmPassword'])) { echo $_SESSION['storeConfirmPassword']; unset($_SESSION['storeConfirmPassword']); }; ?>">
            <span class="error"><?php if (isset($_SESSION['conPassError'])) { echo $_SESSION['conPassError']; unset($_SESSION['conPassError']); }; ?></span>
            <br>
            <input class="submit btn-submit" name="submit" type="submit" value="Register">
        </form>
        <p>Already a user? <a class="form-link" href="login">Login..</a></p>
    </div>

<?php
  include 'footer.php';
?>
