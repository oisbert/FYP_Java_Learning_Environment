<!DOCTYPE html>
<html>
   <head>
      <title>
         Embedding an online compiler 
         into a website
      </title>
      <script language="javascript" type="text/javascript" src="/static/js/codemirror-5.62.0/lib/codemirror.js"></script>
      <link rel="stylesheet" type="text/css" href="/static/js/codemirror-5.62.0/lib/codemirror.css">
      </link>
      <script language="java" type="text/javascript" src="/codemirror-5.62.0/addon/edit/matchbrackets.js"></script>
      <script language="java" type="text/javascript" src="/static/js/codemirror-5.62.0/mode/perl/perl.js"></script>
   </head>
   <link rel="stylesheet" type="text/css" href="css/lessonEdit.css?v=<?php echo time(); ?>">
   <body>
      <?php 
         include ("validateLoggedIn.php");
         include("headerTeacher.html");
         include("lessonData.php");
         ?>
      <h1>
      Edit chalkboard lesson for Object/Classes
      <h1>
      <div class ="lesson-area">
      <form method="post" >  
      <textarea name="description" type="text" rows="30" cols="70">
      </textarea>
         <input type="submit" name="submit" value="Submit">  
      </form>
      </div>
   
   </body>
   <?php
         if (isset($_POST["submit"])) {
            $description = $_POST["description"];
            $sql = "UPDATE lessons SET description = '$description' WHERE lessonID=2";
            getLessonData(2, $description);
            if ($conn->query($sql) === TRUE ) {
               echo "Chalkboard updated";
            } else {
               echo "Error updating Chalkboard: " . $conn->error;
            }
         }
            $conn->close();
         
      ?>
</html>