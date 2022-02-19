<!DOCTYPE html>
<html>
   <head>
      <title>
         Embedding an online compiler 
         into a website
      </title>
      </link>
      <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/autoGrader.css?v=<?php echo time(); ?>">
   <body>
      


      <?php
      include ("headerTeacher.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      include ("methodChecker.php");
      include ("javaClassNameChecker.php");
      include ("checkMethodDeclaration.php");
      include ("checkOutput.php");
      include ("unlinkFile.php");
      //$_SESSION['user'] = $userID;
      $taskID = $_GET['taskID'];
      $taskTitle = $_GET['taskTitle'];
      $userIDtask = $_GET['userID'];
      $userFile = $_GET['filePathUser'];


      //submit value holders
      $Captest = NULL;
      $Captestfail = NULL;
      $statictest = NULL;
      $statictestfail = NULL;
      $formatCheck = NULL;
      $formatCheckFailed = NULL;
      $outputCheck = NULL;
      $outputCheckFailed = NULL;
      $lowercaseMethod = NULL;
      $lowercaseMethodFailed = NULL;


      $targetDir = "taskUploads/{$taskTitle}/{$userIDtask}/{$userFile}";
      $new_str = str_replace(' ', '', $targetDir);
      $myfile = file_get_contents($new_str, "r") or die("Unable to open file!");
      //echo $new_str;
      //echo "-------------- test 1 ----------------";

      print "<div class = auto-background>";
      print "<div class = running-test-1>";
      if(getNextWord($myfile) == true){
         $Captest = "---Test 1 passed: Class file starts with Capital letter ✔️";
         print "<H1>$Captest</H1>";
      }
      else{
         $Captestfail = "---Test 1 Failed: Class file does not start with Capital letter ❌";
         print "<H1>$Captestfail</H1>";
      }
      print "</div>";
      $lines = explode("\n", $myfile);

      //echo "-------------- test 2 ----------------";

      print "<div class = running-test-2>";
      $count = 0;
      foreach($lines as $word) {
         if(checkForStatic($word) == true){
            //print "<H4>Test 2 passed: All methods declared as static </H4>";  
      }
      else{
         $count++;
         //print "<H1>Test 2 Failed: Method declared without static</H1>";
      }
      }

      if($count == 0){
         $statictest = "---Test 2 passed: All methods declared as static ✔️";
         print "<H1>$statictest</H1>";
      }
      else{
         $statictestfail = "---Test 2 Failed: Method declared without static ❌";
         print "<H1>$statictestfail</H1>";
      }
      print "</div>";

      $targetDir2 = "tasksAnswers/Answer{$userFile}";
      $new_str2 = str_replace(' ', '', $targetDir2);
      $AnswerFile = file_get_contents($new_str2, "r") or die("Unable to open file!");

      $targetDir3 = "taskUploads/{$taskTitle}/{$userIDtask}/";
      $new_str3 = str_replace(' ', '',  $targetDir3);

      $current = file_get_contents("tasksAnswers/Answer{$userFile}");
      $f = fopen("Answer{$userFile}", 'w');

      $current2 = file_get_contents("{$new_str3}/{$userFile}");
      $f2 = fopen("{$userFile}", 'w');

      // Write the contents back to the file
      file_put_contents("Answer{$userFile}", $current);
      file_put_contents("{$userFile}", $current2);

      $FileAnswer = "Answer{$userFile}";

      //echo "-------------- test 3 ----------------";
      print "<div class = running-test-3>";
      if(checkMethodName($userFile) == true){
         $lowercaseMethod = "---Test 3 passed: All methods have a lowercase ✔️";
         print "<H1>$lowercaseMethod </H1>";
      }
     else{
         $lowercaseMethodFailed = "---Test 3 Failed: methods detected without a lowercase ❌";
         print "<H1>$lowercaseMethodFailed</H1>";
 
     }

      print "</div>";
      //echo "-------------- test 4 ----------------";
      print "<div class = running-test-4>";

      $FormatCheck = 0;
      $outputCheck = 0;
      OutputChecker($userFile,$FileAnswer, $FormatCheck ,$outputCheck);

      if($FormatCheck > 0){
         $formatCheckFailed = "---Test 4: Failed formatting was incorrect ❌";
     }
     else{
         $formatCheck = "---Test 4: Pass Answer format check ✔️";
 
     }
 
     if($outputCheck > 0){
         $outputCheckFailed = "---Test 5: Failed output was incorrect ❌";
     }
     else{
         $outputCheck = "---Test 5: Pass Answer output check ✔️";
     }
      print "</div>";


      array_map('unlink', glob("*.class"));
      array_map('unlink', glob("Answer{$userFile}"));
      array_map('unlink', glob("{$userFile}"));

      //feedbackbox

      print "</div>";
      ?>
   <div class = "feedback">
      <form action="autoGradeSubmit.php?taskID=<?php echo $taskID ?> &userID=<?php echo $userIDtask?>" method="post" >
      <textarea rows="20" cols="55" name="content">
      <?php 
      echo $Captest; 
      echo $Captestfail;
      ?>

      <?php echo $statictest;
         echo $statictestfail;
      ?>

      <?php echo $lowercaseMethod;
         echo  $lowercaseMethodFailed;
      ?>
                     
      <?php echo $formatCheck;
         echo $formatCheckFailed;
      ?>

      <?php echo $outputCheck;
         echo $outputCheckFailed;
      ?>
      
      </textarea>
      <input type="submit"  name="submit" value="Submit Feedback">
         </form>
      </div>
   </body>

</html>





