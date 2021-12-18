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
      <div class = "excution">
         <H1> Output </H1>
         <div class = excutionOutput>
         <?php
            if (file_exists("Hello.java")){
                $file = "Hello.java";
                $current = file_get_contents($file);
                echo shell_exec("javac Hello.java && java Hello");
                echo shell_exec("javac Hello.java > log.txt 2>&1");
                echo nl2br(file_get_contents( "log.txt" ));
            } 
            ?>
            </div>
      </div>
      <?php 
         include ("validateLoggedIn.php");
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
               <form action="processCode.php" method="post">
                  <textarea id = "compiler" rows="20" cols="55" name="comment" >
                  <?php
            echo $current;
            ?>
      </textarea>
      <input type="submit" value="Compile">
      </form>
      <h1>
      Lesson Plan
      <h1>
      <div class ="lesson-area">
      <?php
          $sql = "SELECT descriptions
            FROM lessons 
            WHERE lessonID = 1;";
        $result =  $conn->query($sql);

        if($row = $result->fetch_assoc()) {
            print "<p class='userDetails text-left'>{$row['descriptions']}</p>";
        } else {
            print "<p class='text-left'>No Current Employer.</p>";
        }
        ?>
        
      </div>
      <div class = 'button-wrapper'>
	   <div class="buttons-holder">
		   <a href="#" class="button play"  role="button">Play</a>
		   <a href="#" class="button pause" role="button">Pause</a>
		   <a href="#" class="button restart" role="button">Restart</a>
	   </div><!--/.buttons-holder -->
      </div>

      <div class = "animation-frame">
         <img class = "bucket" src = "./images/bucket.png"></div>
         <div class = "square"></div>
         <div class = "circle"></div>
      </div>

      <script src="js/polymorphism.js"></script>
      
   </body>
</html>

