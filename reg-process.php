<?php
session_start();

// Set variables
$name = ($_POST['name']);
$sName = ($_POST['sName']);
$email = ($_POST['email']);
$password = ($_POST['password']);
$confirmPassword = ($_POST['confirmPassword']);
// Global variables
$_SESSION["storeName"] = $name;
$_SESSION["storeSName"] = $sName;
$_SESSION["storeEmail"] = $email;
$_SESSION["storePassword"] = $password;
$_SESSION["storeConfirmPassword"] = $confirmPassword;

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name
   $validName = true;
   // check if field is populated
  if (empty($_POST["name"])) {
    $_SESSION["nameError"] = "Your first name is required";
    $validName = false;
  } else {
    // run function to clean up input strings
    $name = test_input($_POST["name"]);
    // check if name contains only letters, a '-' or a space
    if (!preg_match("/^[a-zA-Z -]*$/",$name)) {
      $_SESSION["nameError"] = "Only letters, a hyphen and a space are allowed";
      $validName = false;
    }
    // check that name has at least two letters
    if (strlen($name) < 2) {
      $_SESSION["nameError"] = "Your name must be at least 2 letters";
      $validName = false;
    }
  }
  // validate surname
  $validSName = true;
  // check if field is populated
  if (empty($_POST["sName"])) {
    $_SESSION["sNameError"] = "Your surname is required";
    $validSName = false;
  } else {
    // run function to clean up input strings
    $sName = test_input($_POST["sName"]);
    // check if name contains only letters, a '-' or a space
    if (!preg_match("/^[a-zA-Z -]*$/",$sName)) {
      $_SESSION["sNameError"] = "Only letters, a hyphen and a space are allowed";
      $validSName = false;
    }
    // check that name has at least two letters
    if (strlen($sName) < 2) {
      $_SESSION["sNameError"] = "Your surname must be at least 2 letters";
      $validSName = false;
    }
  }
  // validate email address
  $validEmail = true;
  // check if field is populated
  if (empty($_POST["email"])) {
    $_SESSION["emailError"] = "Your email is required";
    $validEmail = false;
  } else {
    // run function to clean up input strings
    $email = test_input($_POST["email"]);
    // check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION["emailError"] = "Your email is invalid";
      $validEmail = false;
    }
  }
  // validate password
  $validPassword = true;
  // check if field is populated
  if (empty($_POST["password"])) {
    $_SESSION["passError"] = "A password is required";
    $validPassword = false;
  } else {
    // run function to clean up input strings
    $password = test_input($_POST["password"]);
    // check password meets minimum strength requirement
    if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/",$password)) {
      $_SESSION["passError"] = "Password must be at least 8 characters long, have an uppercase and a lowercase letter, a number and a special character";
      $validPassword = false;
    }
  }
  //validate confirm password
  $validConfirmPassword = true;
  // check if field is populated
  if (empty($_POST["confirmPassword"])) {
    $_SESSION["conPassError"] = "Please confirm password";
    $validConfirmPassword = false;
  } else {
    // run function to clean up input strings
    $confirmPassword = test_input($_POST["confirmPassword"]);
    // check that passwords match
    if ($confirmPassword !== $password) {
      $_SESSION["conPassError"] = "Passwords do not match";
      $validConfirmPassword = false;
    }
  }
  $password = md5($password);
  $confirmPassword = md5($confirmPassword);
}

// function to clean up input strings before adding to db
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// If all validation passes set validForm variable to true
$validForm = $validName && $validSName && $validEmail && $validPassword && $validConfirmPassword;

// Only connect to database if form passes validation
if ($validForm) {
    //Create connection
    include 'db-connect.php';
    // Check whether email address has already been registered in the database
    $checkEmail = "SELECT email FROM users WHERE email='$email'";
    $result = $mysqli->query($checkEmail);
    if ($result->num_rows == 0) {
        // if email has not previously been registered, add new user details to database
        $addData = "INSERT INTO users (firstName, lastName, email, password)
        VALUES ('$name', '$sName', '$email', '$password')";
        // if insert is successful redirect to login page and send email notifications
        if ($mysqli->query($addData)) {
            include 'admin-send-email.php';
            include 'user-send-email.php';
            header('Location: login');
        }  else {
          // if insert is unsuccessful throw error
           header('location: registration');
           $_SESSION["dbError"] = "An error has occurred: " . $addData . " " . $mysqli->error;
           }
           // close db connection
           $mysqli->close();
    } else {
        // if email already exists in db, throw error
        header('location: registration');
        $_SESSION["emailError"] = "This email address is already registered";
    }
} else {
    // if form does not pass validation redirect back to registration page
    header('Location: registration');
  }
