<?php
    //the following code updates the current code in the editor with the users changes on the Interfaces page
    include ("validateLoggedIn.php");
    include ("IDtoLetter.php");
    $_SESSION['user'] = $userID;
    //convert userID to letter
    $userIDtoLetters = num2alpha($userID);
    //get contents from the form
    $comment = $_POST["comment-editor"];
    //load the file into a variable called file
    $file = "{$userIDtoLetters}Interfaces.java";
    //copy the contents from the text editor over to the original file
    file_put_contents($file,$comment);
    header('Location: Interfaces.php');
?>