<!DOCTYPE html>
<html>
   <!--The following code is for editing the chalkboard on the lessons page (Interfaces)-->
   <head>
      <title>
         Chalkboard Interface
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
      Edit chalkboard lesson for Interfaces
      <h1>
      <!--text box to edit the lesson-->
      <div class ="lesson-area">
      <form method="post" >  
      <textarea name="description" type="text" rows="30" cols="70">
      </textarea>
         <input type="submit" name="submit" value="Submit">  
      </form>
      </div>
   
   </body>
   <?php
      //when the user has submitted the form this code executes and updates the lessons data in the database
         if (isset($_POST["submit"])) {
            $description = $_POST["description"];
            //update the lesson data where the lessonID is 3 a.k.a the Interfaces lesson
            $sql = "UPDATE lessons SET description = '$description' WHERE lessonID=3";
            getLessonData(3, $description);
            if ($conn->query($sql) === TRUE ) {
               //echo "Chalkboard updated successfully";
            } else {
               echo "Error updating Chalkboard: " . $conn->error;
            }
         }
            $conn->close();
         
      ?>
</html>
