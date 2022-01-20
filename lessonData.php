<?php
    function getLessonData($uID, $description) {
        include ("serverConfig.php");
        $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed:" .$conn -> connect_error);
        }
     
        $sql = "select * from lessons where lessonID =\"{$uID}%\";";
        $result = $conn -> query($sql);

        if ($conn -> query($sql) === TRUE) {
           echo "Chalkboard updated successfully";
        } else {
           $insert = "INSERT INTO lessons (lessonID, description) VALUES ({$uID}, '{$description}')";

           if ($conn->query($insert) === TRUE) {
            echo "Record updated successfully";
            }else {
           //echo "Error updating record: " . $conn->error;
           }

           $conn->close();
        }
        error_reporting(0);
        $conn->close();
     
        return $result->fetch_assoc();
     }
?>