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
   <link rel="stylesheet" type="text/css" href="css/polymorphism.css?v=<?php echo time(); ?>">
   <body>
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
      <h1>
      Edit the Lesson plan
      <h1>
      <div class ="lesson-area">
      <form method="post" >  
      <textarea name="description" type="text" rows="20" cols="55">
      </textarea>
         <input type="submit" name="submit" value="Submit">  
      </form>
      </div>
   
   </body>
   <?php
         if (isset($_POST["submit"])) {
            $description = $_POST["description"];

            $sql = "UPDATE lessons SET description = '$description' WHERE lessonID=1";
            
            if ($conn->query($sql) === TRUE) {
               echo "Record updated successfully";
            } else {
               echo "Error updating record: " . $conn->error;
            }
         }
            $conn->close();
         
      ?>
</html>



