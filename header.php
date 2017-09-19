<?php
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="description" content="<?php
    if(isset($metaD) && !empty($metaD)) {
       echo $metaD;
    } else {
       echo "PHP login - just another page";
    } ?>" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
    if(isset($title) && !empty($title)) {
       echo $title;
    } else {
       echo "PHP login - Page";
    } ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
  </head>
  <body>
    <div class="container">
