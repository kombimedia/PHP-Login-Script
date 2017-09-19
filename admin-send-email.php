<?php
// define email variables
$fromEmail = "cymessenger@gmail.com";
$fromName = "PHP Form Exercise";
$adminEmail = "cy@kombimedia.nz";
$adminFirstName = "Cy";
$adminSurName = "Messenger";
$userEmail = ($_POST['email']);
$userFirstName = ($_POST['name']);
$userSurName = ($_POST['sName']);
$headers = "To: ".$adminFirstName." " .$adminSurName." <".$adminEmail."> \r\n";
$headers .= "From: ".$fromName." <".$fromEmail."> \r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
// construct admin notification email
$subject = $userFirstName . " " . $userSurName . " has just registered";
$message = "<p><b>You have a new registered user!</b></p><p>Name: " . $userFirstName . " " . $userSurName . "</p><p>" . "Email: " . $userEmail . "</p>";
mail("", $subject, $message, $headers);

// simple email for testing
//mail($_POST['email'], 'Registration was successful', 'All sorted, you can login now ' . $_POST["name"] . "!");
//mail($_POST['adminEmail'], 'A new user has registered', 'New users name is ' . $_POST["name"] . "!");

