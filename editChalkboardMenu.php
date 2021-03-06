<!DOCTYPE html>
<html lang="en">
       <!-- 
         Menu that shows the avalible chalkboards to edit for the teacher 
      -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/lessonChalkboard.css?v=<?php echo time(); ?>">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
</head>

<body>

    <?php 
    include ("validateLoggedIn.php");
    include ("headerTeacher.html");
    ?>

    <div class="Page-Note">
        <h1>Select a chalkboard you would like to edit<h1>
    </div>
       <!-- 
         Create a grid view of the options avalible
      -->
    <div class="grid-container">
        <div class="grid-item" onClick="location.href='OCedit.php'">
            <div class="title">
                <h1>Objects/classes<h1>
            </div>
        </div>
        <div class="grid-item" onClick="location.href='polymorphismEdit.php'">
            <div class="title">
                <h1>Polymorphism<h1>
            </div>
        </div>
        <div class="grid-item" onClick="location.href='interfacesEdit.php'">
            <div class="title">
                <h1>Interfaces<h1>
            </div>
        </div>
        <div class="grid-item"><div class = "title"><h1>Abstraction<h1></div></div>
        <div class="grid-item"><div class = "title"><h1>Encapsulation<h1></div></div>
        <div class="grid-item"><div class = "title"><h1>Association<h1></div></div>  
        <div class="grid-item"><div class = "title"><h1>Aggregation<h1></div></div> 
        <div class="grid-item"><div class = "title"><h1>Composition<h1></div></div> 
    </div>

    <script src="js/animationLesson.js"></script>
</body>

</html>