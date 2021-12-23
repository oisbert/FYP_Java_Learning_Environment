<?php
    $comment = $_POST["comment-editor"];
    $file = "Polymorphism.java";
    file_put_contents($file,$comment);
    header('Location: polymorphism.php');
?>