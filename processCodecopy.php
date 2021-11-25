<?php
    $comment = $_POST["comment"];
    $file = "Hello.java";
    file_put_contents($file,$comment);
    header('Location: demotexteditor.php');
?>