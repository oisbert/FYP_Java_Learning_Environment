<?php

include("serverConfig.php");
if (isset($_POST["submit"]))
{

   $title = $_POST["title"];
    
  
   $uploads_dir = 'uploads';

   move_uploaded_file($uploads_dir.'/');

   $sql = "INSERT into tasks(filetitle) VALUES('$title')";
   $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
   if($conn->query($sql) === TRUE){

   echo "File Sucessfully uploaded";
   }
   else{
       echo "Error";
   }
}
?>