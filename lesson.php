<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/lesson.css?v=<?php echo time(); ?>">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
</head>
<body>
<script type="text/javascript">
    //functions to generate the temporary user files when a page is clicked
    //generates the polymorphism file
    function GeneratePolyFiles() {
            window.location.href= 'generatorPoly.php';
        }
    //generates the object and classes file
    function GenerateOCFiles() {
            window.location.href= 'generatorOC.php';
        }
    //generate the interfaces file
    function GenerateInterfaceFiles() {
            window.location.href= 'generatorInterfaces.php';
        }

</script>
    <?php 
    include ("validateLoggedIn.php");
    include ("header.html");
    ?>


<div class="grid-container">
  <div class="grid-item" onClick="GenerateOCFiles()"><div class = "title"><h1>Object/Classes<h1></div></div>
  <div class="grid-item" onClick="GeneratePolyFiles()"><div class = "title"><h1>Polymorphism<h1></div></div>
  <div class="grid-item" onClick="GenerateInterfaceFiles()"><div class = "title"><h1>Interfaces<h1></div></div>
  <div class="grid-item"><div class = "title"><h1>Abstraction<h1></div></div>
  <div class="grid-item"><div class = "title"><h1>Encapsulation<h1></div></div>
  <div class="grid-item"><div class = "title"><h1>Association<h1></div></div>  
  <div class="grid-item"><div class = "title"><h1>Aggregation<h1></div></div> 
  <div class="grid-item"><div class = "title"><h1>Composition<h1></div></div> 
</div>

<script src = "js/animationLesson.js"></script>
</body>
</html>