<!DOCTYPE html>
<html>
  
<head>
    <title>
        Embedding an online compiler 
        into a website
    </title>

</head>
  
<body>
<?php

if (file_exists("Hello.java")){
    $file = "Hello.java";
    $current = file_get_contents($file);
    echo shell_exec("javac Hello.java && java Hello");
    echo shell_exec("javac Hello.java > log.txt 2>&1");
    echo nl2br(file_get_contents( "log.txt" ));
} 

?>

<form action="processCode.php" method="post">
    <textarea rows="20" cols="50" name="comment">
        <?php
        echo $current;
        ?>
    </textarea>
    <input type="submit">
</form>

<div class = "embedded compiler">

</div>

<h1>Lesson plan<h1>
</body>
  
</html>