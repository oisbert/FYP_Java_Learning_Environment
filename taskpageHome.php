<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/taskpageHome.css?v=<?php echo time(); ?>">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
</head>
<body>

    <?php 
    include ("validateLoggedIn.php");
    include ("headerteacher.html");
    ?>


<div class="grid-container">
  <div class="grid-item" onClick="taskPageTeacher.php'"><div class = "title"><h1>View Tasks<h1></div></div>
  <div class="grid-item" onClick="location.href='taskPageTeacher.php'"><div class = "title"><h1>Add task<h1></div></div>
</div>

<script src = "js/animationLesson"></script>
</body>
</html>