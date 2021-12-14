<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/lesson.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>

    <?php 
    include ("validateLoggedIn.php");
    include ("header.html");
    ?>

<h1>display: grid</h1>

<p>Use display: grid; to make a block-level grid container:</p>

<div class="grid-container">
  <div class="grid-item">Objects/classes</div>
  <div class="grid-item" onClick="location.href='polymorphism.php'">Polymorphism</div>
  <div class="grid-item">3</div>  
  <div class="grid-item">4</div>
  <div class="grid-item">5</div>
  <div class="grid-item">6</div>  
  <div class="grid-item">7</div>
  <div class="grid-item">8</div>
  <div class="grid-item">9</div>  
</div>
</body>
</html>