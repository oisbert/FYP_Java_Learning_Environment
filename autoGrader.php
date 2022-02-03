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
      include ("unlinkFile.php");
      //$_SESSION['user'] = $userID;

      $targetDir = "taskUploads/{$taskTitle}/{$GetUser}";
      ?>
   </body>
</html>
