<?php
//the following code updates the current code in the editor with the users changes on the exercises page
    include ("validateLoggedIn.php");
    include ("IDtoLetter.php");
    $_SESSION['user'] = $userID;
    //convert userID to letter
    $userIDtoLetters = num2alpha($userID);
    //get contents from the form
    $comment = $_POST["comment-editor"];
    //load the file into a varible called file
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