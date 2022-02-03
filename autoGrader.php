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
   <link rel="stylesheet" type="text/css" href="css/excercisePage.css?v=<?php echo time(); ?>">
   <body>


      <?php
      include ("headerTeacher.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      include ("methodChecker.php");
      include ("javaClassNameChecker.php");
      include ("checkOutput.php");
      include ("unlinkFile.php");
      //$_SESSION['user'] = $userID;
      $taskID = $_GET['taskID'];
      $taskTitle = $_GET['taskTitle'];
      $userIDtask = $_GET['userID'];
      $userFile = $_GET['filePathUser'];

      $targetDir = "taskUploads/{$taskTitle}/{$userIDtask}/{$userFile}";
      $new_str = str_replace(' ', '', $targetDir);
      $myfile = file_get_contents($new_str, "r") or die("Unable to open file!");
      echo $new_str;
      echo "-------------- test 1 ----------------";
      getNextWord($myfile);

      $lines = explode("\n", $myfile);

      echo "-------------- test 2 ----------------";
      foreach($lines as $word) {
          echo "<br>". checkForStatic($word) . "<br/>\n";   
      }

      $targetDir2 = "tasksAnswers/Answer{$userFile}";
      $new_str2 = str_replace(' ', '', $targetDir2);
      $AnswerFile = file_get_contents($new_str, "r") or die("Unable to open file!");

      echo "-------------- test 3 ----------------";
      OutputChecker($new_str,$new_str2);

      //extension of files you want to remove.
      $remove_ext = '.class';
      $fullPath = __DIR__ . "tasksAnswers/";
      //remove desired extension files in current directory
      array_map('unlink', glob("tasksAnswers/*.class"));

      $targetDir3 = "taskUploads/{$taskTitle}/{$userIDtask}/";
      $new_str3 = str_replace(' ', '',  $targetDir3);

      array_map('unlink', glob("{$new_str3}/*.class"));

      ?>
   </body>
</html>


