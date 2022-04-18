<?php
    /*
        The following code is to genenerate a random file into the intergrated compiler on the exercises page
    */
    include ("randomFileGenerator.php");
    include ("IDtoLetter.php");

    $fileAnswerholder = "temp";

    $userIDtoLetters = num2alpha($userID); //convert the user id to a letter
    $randomFile = randomFileGenerator(); //Grab a random file from random file generator see randomFileGenerator.php for more info
    $userPoly = fopen("{$userIDtoLetters}Random.java", "w+"); //open the tempory user file for the random generated code exercise
    $current = file_get_contents("{$randomFile}", "w"); //get the contents of the random file
    $userPolyEdit = fopen("{$userIDtoLetters}Random.java", "w");
    fwrite($userPolyEdit, $current); //put the contents of the random file into the user temporary file
    $holder = file_get_contents("{$userIDtoLetters}Random.java"); //get the contents of the temporary file
    $filename_without_ext = basename($randomFile, '.java'); //create a random file without the extension
    $fileNameFixed = strstr($filename_without_ext, '_', true); //get the file name

    //get the file contents of the answer file
    $getAnswerContents = file_get_contents("{$fileAnswer}", "w");
    
    $replace = str_replace("{$fileNameFixed}", "{$userIDtoLetters}Random",$holder); //replace all  with userIDinterface
    file_put_contents("{$userIDtoLetters}Random.java", $replace); //replace all the public class "filename" with userIDRandom
    fclose($userPolyEdit);
    $classPoly = fopen("{$userIDtoLetters}Random.class", "w");
?>