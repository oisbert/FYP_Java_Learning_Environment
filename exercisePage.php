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
   <link rel="stylesheet" type="text/css" href="css/polymorphism.css?v=<?php echo time(); ?>">
   <body>
      <?php
      include ("header.html");
      include ("validateLoggedIn.php");
      include ("serverConfig.php");
      include ("IDtoLetter.php");
      include ("randomFileGenerator.php");
      $_SESSION['user'] = $userID;
   
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
      $replace = str_replace("{$fileNameFixed}", "{$userIDtoLetters}Random",$holder);
      file_put_contents("{$userIDtoLetters}Random.java", $replace);
      fclose($userPolyEdit);
      $classPoly = fopen("{$userIDtoLetters}Random.class", "w");
      ?>
      <br>
      <div class = "excution" >
         <div class = excutionOutput >
            <?php
               if (file_exists("{$userIDtoLetters}Random.java")){
                   $file = "{$userIDtoLetters}Random.java";
                   $current = file_get_contents($file);
                   echo shell_exec("javac {$userIDtoLetters}Random.java && java {$userIDtoLetters}Random");
                   echo shell_exec("javac {$userIDtoLetters}Random.java > log.txt 2>&1");
                   echo nl2br(file_get_contents( "log.txt" ));
               } 
               ?>
         </div>
      </div>
      <?php 
         function getLessonData($uID) {
            include ("serverConfig.php");
            $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed:" .$conn -> connect_error);
            }
         
            $sql = "select * from lessons where lessonID =\"{$uID}%\";";
            $result = $conn -> query($sql);
            $conn->close();
         
            return $result->fetch_assoc();
         }
         ?>
         <br>
         <br>
      <div class = "compiler">
         <form action="processCodeExercises.php" method="post" >
            <textarea data-editor = "java" rows="20" cols="55" name="comment-editor"  data-gutter="1" >
            <?php
               echo $current;
               ?>
            </textarea>
            <input type="submit" value="Compile">
         </form>
      </div>

      
  
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
      <script src="js/syntax.js" type="text/javascript"></script>
      <script src="js/mode-java" type="text/javascript"></script>
      <script src="js/animatePolyLesson" type="text/javascript"></script>
   </body>
</html>
