<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/lessonEdit.css?v=<?php echo time(); ?>">
    <title>Welcome Teacher</title>
</head>
<body>
    <?php
    include ("validateLoggedIn.php");
    include("headerTeacher.html");

    ?>

    <p id="ListLessons">This is the top of the file</p>
        <ul> Select a lesson plan to edit
        <li><a href="polymorphismEdit.php">Object/classes</a></li>
        <li><a href="polymorphismEdit.php">Polymorphism</a></li>
        <li><a href="addTask.php">AddTask</a></li>
        <li><a href="taskPageTeacher.php">Task</a></li>
    </ul>
    <p><a href="#top">This link goes to the top</a></p>
</body>
</html>