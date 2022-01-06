<?php
    include ("validateLoggedIn.php");
    include ("IDtoLetter.php");
    $_SESSION['user'] = $userID;

    $userIDtoLetters = num2alpha($userID);

    $comment = $_POST["comment-editor"];
    $file = "{$userIDtoLetters}Random.java";
    file_put_contents($file,$comment);
      
      $filename_without_ext=$_SESSION['varname'];
      $userIDtoLetters = num2alpha($userID);

      foreach( glob('excerciseAnswers' . '/*.*') as $fileAnswer){
         if($fileAnswer == "excerciseAnswers/{$filename_without_ext}Answer.java"){
         echo $fileAnswer;
         
         }
     }
     fopen("Random.java", "w+");
    $getAnswerContents = file_get_contents("{$fileAnswer}", "w");
    file_put_contents("Random.java", $getAnswerContents);
    header('Location: exercisePage.php');
?>