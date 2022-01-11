<?php
    include ("randomFileGenerator.php");
    include ("IDtoLetter.php");
    //$userID =  $_SESSION['user'];
    $fileAnswerholder = "temp";

    $userIDtoLetters = num2alpha($userID);
    $randomFile = randomFileGenerator();
    $userPoly = fopen("{$userIDtoLetters}Random.java", "w+");
    $current = file_get_contents("{$randomFile}", "w");
    $userPolyEdit = fopen("{$userIDtoLetters}Random.java", "w");
    fwrite($userPolyEdit, $current);
    $holder = file_get_contents("{$userIDtoLetters}Random.java");
    $filename_without_ext = basename($randomFile, '.java');
    $fileNameFixed = strstr($filename_without_ext, '_', true);
    echo $filename_without_ext;


    foreach( glob('excerciseAnswers' . '/*.*') as $fileAnswer){
        if($fileAnswer == "excerciseAnswers/{$filename_without_ext}Answer.java"){
        echo $fileAnswer;
        
        }
    }

    $getAnswerContents = file_get_contents("{$fileAnswer}", "w");
    echo $getAnswerContents;

    $replace = str_replace("{$fileNameFixed}", "{$userIDtoLetters}Random",$holder);
    file_put_contents("{$userIDtoLetters}Random.java", $replace);
    fclose($userPolyEdit);
    $classPoly = fopen("{$userIDtoLetters}Random.class", "w");
?>