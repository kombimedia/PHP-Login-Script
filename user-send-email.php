<?php
// define email variables
$fromEmail = "cymessenger@gmail.com";
$fromName = "PHP Form Exercise";
$email = ($_POST['email']);
$firstName = ($_POST['name']);
$surName = ($_POST['sName']);
$headers = "To: ".$firstName." " .$surName." <".$email."> \r\n";
$headers .= "From: ".$fromName." <".$fromEmail."> \r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
// construct user notification email
$subject = "Your Registration was successful";
$message = "<p><b>Welcome to the club " . $firstName . '!</b></p><p>Let\'s get straight into it.. <a href="http://exercises/php-login/login.php">Click here to Login</a></p><p>User Name: ' . $email . "</p><p>Password: The one you entered in the registration form</p>";
mail("", $subject, $message, $headers);

// simple email for testing
//mail($_POST['email'], 'Registration was successful', 'All sorted, you can login now ' . $_POST["name"] . "!");
//mail($_POST['adminEmail'], 'A new user has registered', 'New users name is ' . $_POST["name"] . "!");

