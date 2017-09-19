<?php
$mysqli = new mysqli ("localhost","root","12Dev-Site34", "login-db");
    // Check connection
        if ($mysqli->connect_error) {
          die("Connection failed: " . $mysqli->connect_error);
        }
?>