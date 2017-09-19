<?php
session_start();

// Set variables
$loginEmail = ($_POST['loginEmail']);
$loginPassword = ($_POST['loginPassword']);
//Global variables
$_SESSION["storeLoginEmail"] = $loginEmail;
// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // validate email
  $validLoginEmail = true;
  // check if field is populated
  if (empty($_POST["loginEmail"])) {
    $validLoginEmail = false;
  } else {
    // run function to clean up input strings
    $loginEmail = test_input($_POST["loginEmail"]);
    $validLoginEmail = true;
    }
  // validate password
  $validLoginPassword = true;
  // check if field is populated
  if (empty($_POST["loginPassword"])) {
    $validLoginPassword = false;
  } else {
    // run function to clean up input strings
    $loginPassword = test_input($_POST["loginPassword"]);
    $validLoginPassword = true;
    }
  $loginPassword = md5($loginPassword);
}

// function to clean up input strings before adding to db
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// If all validation passes set validLoginForm variable to true
$validLoginForm = $validLoginEmail && $validLoginPassword;

// Only connect to database if form passes validation
if ($validLoginForm) {
    // Create connection
    include 'db-connect.php';
    // get users email and password from database and save to variables
    $sql = "SELECT email, password FROM users";
    $result = $mysqli->query($sql);
    // check ant data exists
    if ($result->num_rows > 0) {
        // fetch data and store to variables
        while($row = $result->fetch_assoc()) {
            $storedEmail = $row["email"];
            $storedPass = $row["password"];
        }
    }
    // close db connection
    $mysqli->close();
}
// compare current email and password to database. If match found redirect to welcome page
if ($loginEmail === $storedEmail && $loginPassword === $storedPass) {
    header('Location: welcome');
} else {
    // if user details are not in db, throw error
    header('Location: login');
    $_SESSION['loginError'] = "Your email or password are invalid";
  }
?>
