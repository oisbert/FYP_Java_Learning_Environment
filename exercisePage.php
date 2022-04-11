<!DOCTYPE html>
<html>
      <!-- 
         code for the exercises page
      -->
   <head>
      <title>
         Exercise Page 
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/excercisePage.css?v=<?php echo time(); ?>">
   <body>

<script>
   //add points function call
   function AddPoints(variable) {
            window.location.href= 'addpoints.php?userID='+ variable;
        }

</script>

      <?php
      include ("header.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      include ("unlinkFile.php");
      //get the id of the current user logged in 
      $_SESSION['user'] = $userID;
      
      //load the random generated exercise file into the variable
      $filename_without_ext=$_SESSION['varname'];
      
      //convert the current user id to alphabetical format
      $userIDtoLetters = num2alpha($userID);
        //search throught the exercises folder
      foreach( glob('excerciseAnswers' . '/*.*') as $fileAnswer){
         //if a file is found matching the user tempory file load that file into an answer file
         if($fileAnswer == "excerciseAnswers/{$filename_without_ext}Answer.java"){
        
            $getAnswerContents = file_get_contents("{$fileAnswer}", "w");
         }
     }
     

      ?>
      <br>
      <!--Display an explanation of the function of the exercises page-->
      <div class = "information">
      <h1>Whats this?</h1>
      <p>A random question is loaded into the text editor.
         Try to solve the question and gain points to be added to the leaderboard.
      </p>
      </div>
      <!--Create the output of the code-->
      <div class = "excution" >
         <div class = excutionOutput >
            <?php
            //if the file exists 
               if (file_exists("{$userIDtoLetters}Random.java")){
                  //load the file contents into a variable called file
                   $file = "{$userIDtoLetters}Random.java";
                   //put the contents into a vairable called current
                   $current = file_get_contents($file);
                   //execute the code on the server shell and print
                   echo shell_exec("javac $file && java {$userIDtoLetters}Random");
                  //if the runtime environment display the logs 
                   echo shell_exec("javac {$userIDtoLetters}Random.java > log.txt 2>&1");
                   echo nl2br(file_get_contents( "log.txt" ));
               } 
               ?>
         </div>
      </div>
       <!--create the compiler box-->
      <div class = "compiler">
         <!--create the compiler form to execute the code-->
         <form action="processCodeExercises.php" method="post" >
             <!--load the data editor javascript onto the text box to syntax highlight the code-->
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
                //load the current code into the editor 
               echo $current;
               ?>
            </textarea>
            <!--create submit button to execute the code and send it to processCodeExercises.php-->
            <input type="submit" value="Compile">
         </form>
      </div>


      <?php
         //we need to check if the usets file is correct

         //Get the answer contents line by line
         $lines = explode("\n", $getAnswerContents);
         //skip the first two lines of the answer as we dont need to check the public class name
         $skipped_contentAnswer = implode("\n", array_slice($lines, 2));
         //remove all spaces
         $skipped_contentAnswer = preg_replace('/\s+/', '',   $skipped_contentAnswer);
         //get the contents of the userfile 
         $getUserContents = file_get_contents("{$userIDtoLetters}Random.java", "w");
         //get the user file line by line
         $lines = explode("\n", $getUserContents);
         $skipped_contentUser = implode("\n", array_slice($lines, 3));
         //remove all spaces
         $skipped_contentUser = preg_replace('/\s+/', '',  $skipped_contentUser);
         
         //compare the two files to check how much they match and load the comparision into a percentage variable
         similar_text("{$skipped_contentAnswer}","{$skipped_contentUser}",$percent);

         //if the percent is greater than 90 do the following
         if($percent > 90){
            //load the files into variables to delete later
            $RandomDelete = "Random.java";
            $RandomClassDelete = "Random.class";
            //print out user info
            print "<H3 id = 'animation-info1' class = 'Answer-info'>Running tests</H3>";
            print "<H3 id = 'animation-info2'class = 'Answer-info'>Sit tight and we will check your output</H3>";
            //put the contents from the answer file into the random.java
            file_put_contents("Random.java", $getAnswerContents);

            //execute the answer file
            $answer = shell_exec("javac {$userIDtoLetters}Random.java && java {$userIDtoLetters}Random");
            shell_exec("javac {$userIDtoLetters}Random.java > log2.txt 2>&1");
            $log1 = nl2br(file_get_contents( "log.txt" ));

            //execute the user file
            $answer2 = shell_exec("javac Random.java && java Random");
            shell_exec("javac Random.java > log2.txt 2>&1");
            $log2 = nl2br(file_get_contents( "log2.txt" ));

            //if the outputs of both the files match
            if(strval($answer) == strval($answer2)){
               //print the answer was correct
               print "<H3 id = 'animation-info3' class = 'Answer-info'>Your answer was correct</H3>";
               //load the points button
               $ButtonSQL = "SELECT pointtracker FROM users WHERE userID = {$userID} AND pointtracker = 0;";
                    $ButtonSQLResult = $conn -> query($ButtonSQL);
                    $ButtonSQL = $ButtonSQLResult->fetch_assoc();
               //if the user hasnt already got point in this current session print...
               if($ButtonSQL) {
                  //this button and disable it 
                  print "<button type ='button' id = 'animation-info6' class='submitpoints' disabled '>Already submitted points</button> ";
               } else {
                  //this button and enable it
                  print "<button type ='button' id = 'animation-info6' class='submitpoints' onClick='AddPoints({$userID})'>Collect Points</button>";
               }
               //remove the temporary class files created during execution
               unlinkFiles($RandomDelete, $RandomClassDelete);
            }
            //if the answers dont match print ..
            else if($answer != $answer2){
               print "<H3 id = 'animation-info4' class = 'Answer-info'>Output is not the same as Answer try again</H3>";
            }
            
         }
         //if the file contents dont match over 90 percent print...
         else{
            print "<H1 id = 'animation-info5' class = 'Answer-info'>Your answer is wrong (tip: checkformatting and output) </H1>";
         }
      ?>
      
  
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
      <script src="js/syntaxCompiler.js" type="text/javascript"></script>
      <script src="js/animatePolyLesson" type="text/javascript"></script>
   </body>
</html>
